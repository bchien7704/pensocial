<?php namespace Penst\Services\User;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Penst\Cores\Cache\CacheInterface;
use Penst\Cores\Contexts\WorkContextInterface;
use Penst\Cores\Contexts\WorkContextIterface;
use Penst\Cores\Cookies\CookieInterface;
use Penst\Cores\Exceptions\EntityNotFoundException;
use Penst\Cores\Hashing\HasherInterface;
use Penst\Cores\Repositories\Us\GroupRepositoryInterface;
use Penst\Cores\Repositories\Us\UserRepositoryInterface;
use Penst\Cores\Sessions\SessionInterface;
use Penst\Exceptions\ValidationException;
use Penst\Models\Seo\UrlRecord;
use Penst\Models\Us\Group;
use Penst\Models\Us\User;
use DB;


/**
 * Interface SettingInterface
 * @package Fully\Repositories\Setting
 * @author Sefa Karagöz
 */
class UserService implements UserServiceInterface
{

    private $session;
    private $cookie;
    private static $cacheUserKey = "Penst.User.Id-%s";
    private $cache;
    private $userRepository;
    private $groupRepository;
    private $user;
    private $hasher;
    private $workContext;


    /*
     * The Eloquent user model.
     *
     * @var string
     */
    protected $model = 'Penst\Models\Us\User';

    public function __construct(UserRepositoryInterface $userRepository, GroupRepositoryInterface $groupRepository, CacheInterface $cache, SessionInterface $session, CookieInterface $cookie, HasherInterface $hasher, WorkContextInterface $workContext)
    {
        $this->userRepository = $userRepository;
        $this->cache = $cache;
        $this->session = $session;
        $this->hasher = $hasher;
        $this->cookie = $cookie;
        $this->workContext = $workContext;
        $this->groupRepository = $groupRepository;

    }

    /*
     * Attempts to authenticate the given user
     * according to the passed credentials.
     *
     * @param  array $credentials
     * @param  bool $remember
     * @return \Cartalyst\Sentry\Users\UserInterface
     * @throws \Cartalyst\Sentry\Throttling\UserBannedException
     * @throws \Cartalyst\Sentry\Throttling\UserSuspendedException
     * @throws \Cartalyst\Sentry\Users\LoginRequiredException
     * @throws \Cartalyst\Sentry\Users\PasswordRequiredException
     * @throws \Cartalyst\Sentry\Users\UserNotFoundException
     */
    public function authenticate(array $credentials, $remember = false)
    {

        // We'll default to the login name field, but fallback to a hard-coded

        try {
            $user = $this->findByCredentials($credentials);
        } catch (\Exception $e) {


            throw $e;
        }
        $this->login($user, $remember);

        return $this->user;
    }

    public function logOut()
    {
        Auth::logout();
        $this->session->forget();
        $this->cookie->forget();


    }
    /*
     * Finds a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Cartalyst\Sentry\Users\UserInterface
     * @throws \Cartalyst\Sentry\Users\UserNotFoundException
     */
    public function findByCredentials(array $credentials)
    {
        $model = $this->createModel();
        $loginName = $model->getLoginName();

        if (!array_key_exists($loginName, $credentials)) {
            throw new \InvalidArgumentException("Login attribute [$loginName] was not provided.");
        }

        $passwordName = $model->getPasswordName();

        $query = $model->newQuery();
        $hashableAttributes = $model->getHashableAttributes();
        $hashedCredentials = array();

        // build query from given credentials
        foreach ($credentials as $credential => $value) {
            // Remove hashed attributes to check later as we need to check these
            // values after we retrieved them because of salts
            if (in_array($credential, $hashableAttributes)) {
                $hashedCredentials = array_merge($hashedCredentials, array($credential => $value));
            } else {
                $query = $query->where($credential, '=', $value);
            }
        }

        if (!$user = $query->first()) {
            throw new EntityNotFoundException("A user was not found with the given credentials.");
        }

        // Now check the hashed credentials match ours
        foreach ($hashedCredentials as $credential => $value) {
            if (!$this->hasher->checkhash($value, $user->{$credential})) {
                $message = "A user was found to match all plain text credentials however hashed credential [$credential] did not match.";

                if ($credential == $passwordName) {
                    throw new EntityNotFoundException($message);
                }

                throw new EntityNotFoundException($message);
            } else if ($credential == $passwordName) {
                if (method_exists($this->hasher, 'needsRehashed') &&
                    $this->hasher->needsRehashed($user->{$credential})
                ) {
                    // The algorithm used to create the hash is outdated and insecure.
                    // Rehash the password and save.
                    $user->{$credential} = $value;
                    $user->save();
                }
            }
        }

        return $user;
    }

    /*
     * Logs in the given user and sets properties
     * in the session.
     *
     * @param  \Cartalyst\Sentry\Users\UserInterface  $user
     * @param  bool  $remember
     * @return void
     * @throws \Cartalyst\Sentry\Users\UserNotActivatedException
     */
    public function login(User $user, $remember = false)
    {
        if (!$user->isActivated()) {
            $login = $user->getLogin();
            throw new \Exception("Cannot login user [$login] as they are not activated.");
        }

        $this->user = $user;

        // Create an array of data to persist to the session and / or cookie
        $toPersist = array($user->getId(), $user->getPersistCode());

        // Set sessions
        $this->session->put($toPersist);

        if ($remember) {
            $this->cookie->forever($toPersist);
        }

        // The user model can attach any handlers
        // to the "recordLogin" event.
        $user->recordLogin();
        $this->workContext->setCurrentUser($user);
    }

    public function getById($id)
    {
//        $key = md5(getLang() . $this->cacheKey . '.id.' . $id);
//
//        $key = sprintf(self::$cacheUserKey, $id);
//        if ($this->cache->has($key)) {
//            return $this->cache->get($key);
//        }

        $user = $this->userRepository->find($id);

//        $this->cache->put($key, $user);

        return $user;
    }

    /*
     * Check to see if the user is logged in and activated, and hasn't been banned or suspended.
     *
     * @return bool
     */
    public function check($isCheckAdmin=false)
    {
        if (is_null($this->user)) {
            // Check session first, follow by cookie
            if (!$userArray = $this->session->get() and !$userArray = $this->cookie->get()) {
                return false;
            }

            // Now check our user is an array with two elements,
            // the username followed by the persist code
            if (!is_array($userArray) or count($userArray) !== 2) {
                return false;
            }

            list($id, $persistCode) = $userArray;

            // Let's find our user
            try {
                $user = $this->findById($id);
            } catch (EntityNotFoundException $e) {
                return false;
            }

            // Great! Let's check the session's persist code
            // against the user. If it fails, somebody has tampered
            // with the cookie / session data and we're not allowing
            // a login
            if (!$user->checkPersistCode($persistCode)) {
                return false;
            }

            // Now we'll set the user property on Sentry
            $this->user = $user;
        }

        // Let's check our cached user is indeed activated
        if (!$user = $this->getUser() or !$user->isActivated() or $user->Banned) {
            return false;
        }


        return true;
    }

    /*
     * Finds a user by the given user ID.
     *
     * @param  mixed  $id
     * @return \Cartalyst\Sentry\Users\UserInterface
     * @throws \Cartalyst\Sentry\Users\UserNotFoundException
     */
    public function findById($id)
    {

        if (!$user = $this->userRepository->table()->newQuery()->find($id))
            throw new EntityNotFoundException("A user could not be found with ID [$id].");


        return $user;
    }

    /*
     * Create a new instance of the model.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function createModel()
    {
        $class = '\\' . ltrim($this->model, '\\');

        return new $class;
    }

    /*
     * Returns the current user being used by Sentry, if any.
     *
     * @return \Cartalyst\Sentry\Users\UserInterface
     */
    public function getUser()
    {
        // We will lazily attempt to load our user
        if (is_null($this->user)) {
            $this->check();
        }

        return $this->user;
    }

    public function getAllUser($createdFromUtc = null, $createdToUtc = null, $customerRoleIds = null, $email = null, $pageIndex = 0, $pageSize = 1000)
    {
        // TODO: Implement getAllUser() method.
        $result = new \stdClass();
        $result->pageIndex = $pageIndex;
        $result->pageSize = $pageSize;
        $result->totalItems = 0;
        $result->items = array();
        $model = new User();
        $query = $model->query();
        if ($createdFromUtc != null)
            $query = $query->where('create_at', '>=', $createdFromUtc);
        if ($createdToUtc != null)
            $query = $query->where('create_at', '>=', $createdToUtc);
        if (!isEmptyOrNullString($email))
            $query = $query->where('email', 'like', '%' + $email + '%');
        $user = $query->skip($pageSize * ($pageIndex - 1))->take($pageSize)->get();
        $result->totalItems = count($user);
        $result->items = $user->all();
        return $result;

    }

    public function getOnlineUser($lastActivityFromUtc = null, array $customerRoleIds = [], $email = null, $pageIndex = 0, $pageSize = 10000)
    {
        // TODO: Implement getOnlineUser() method.
    }

    public function deleteUser($id)
    {
        $this->userRepository->delete($id);
    }

    public function  getUserById($id)
    {
        $model = $this->createModel();

        if (!$user = $model->newQuery()->find($id)) {
            throw new EntityNotFoundException("A user could not be found with ID [$id].");
        }

        return $user;
    }

    public function  getUserByIds(array $id = [])
    {

        $query = $this->userRepository->table()->query();
        $query = $query->whereIn('id', $id);
        $user = $query->get();
        return $user;
    }

    public function  getUserByEmail($email)
    {
        $query = $this->userRepository->table()->query();
        $query = $query->whereIn('email', 'like', '%'.$email.'%');
        $user = $query->get();
        return $user;
    }

    public function  insertUser($attributes)
    {
      return  $this->userRepository->create($attributes);
    }

    public function  updateUser($id ,$attributes)
    {
       return $this->userRepository->update($id,$attributes);
    }

    public function  deleteGroup($id)
    {
        $this->groupRepository->delete($id);
    }

    public function  insertGroup(Group $group)
    {
        // TODO: Implement insertGroup() method.
    }

    public function  updateGroup(Group $group)
    {
        // TODO: Implement updateGroup() method.
    }

    public function getGroupById($id)
    {

        if (!$group = $this->groupRepository->table()->newQuery()->find($id)) {
            throw new EntityNotFoundException("A user could not be found with ID [$id].");
        }

        return $group;
    }

    public function  getAllGroup($showHidden = false)
    {
        $query = $this->groupRepository->table()->newQuery();
        if (!$showHidden)
            $query = $query->where('active', '1');
        $groups = $query->get();
        return $groups;

    }

    public  function  getUserByFullName($fullName)
    {
        $query = $this->userRepository->table()->query();
        $query = $query->where('full_name', 'like', '%'.$fullName.'%');
        $user = $query->first();
        return $user;
    }

    public  function getUserForAutocomplete()
    {
        $users = DB::select('CALL user_for_autocomplete');
        return $users;
    }

}