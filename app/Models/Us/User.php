<?php namespace Penst\Models\Us;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Penst\Cores\Seo\SlugableInterface;
use Penst\Models\BaseModel;
use Penst\Models\Seo\UrlRecord;
use Penst\Services\Seo\UrlTrait;
use Hash;
use Request;
use DB;

/**
 * Class Setting
 * @author Sefa Karagöz
 */
class User extends BaseModel implements SlugableInterface,AuthenticatableContract, CanResetPasswordContract

{
    use UrlTrait,Authenticatable, CanResetPassword;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    protected $fillable = array('email', 'username','password','full_name', 'gender','ralationship', 'activated','clubs','school','birthday','online','undergrad','last_ip_address');

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = array(
        'password',
        'activation_code',
    );

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array(
        'activation_code'
    );

    /**
     * Attributes that should be hashed.
     *
     * @var array
     */
    protected $hashableAttributes = array(
        'password',
        'persist_code',
        'reset_password_code'

    );

    /**
     * The Eloquent group model.
     *
     * @var string
     */
    protected static $groupModel = 'Penst\Models\Us\Group';

    /**
     * The user groups pivot table name.
     *
     * @var string
     */
    protected static $userGroupsPivot = 'user_group';

    /**
     * The login attribute.
     *
     * @var string
     */
    protected static $loginAttribute = 'email';


    /**
     * Returns the name for the user's login.
     *
     * @return string
     */
    public function getLoginName()
    {
        return static::$loginAttribute;
    }

    /**
     * Returns the name for the user's password.
     *
     * @return string
     */
    public function getPasswordName()
    {
        return 'password';
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    protected $validationRules = [
        'email' => 'required|email|unique:users,email,<id>',
        'name' => 'required|alpha_num|unique:users,name,<id>',
    ];

    public function groups()
    {
        return $this->belongsToMany(static::$groupModel, static::$userGroupsPivot);
    }

    /**
     * Set the Eloquent model to use for group relationships.
     *
     * @param  string $model
     * @return void
     */
    public static function setGroupModel($model)
    {
        static::$groupModel = $model;
    }

    /**
     * Set the user groups pivot table name.
     *
     * @param  string $tableName
     * @return void
     */
    public static function setUserGroupsPivot($tableName)
    {
        static::$userGroupsPivot = $tableName;
    }

    /**
     * Returns an array of hashable attributes.
     *
     * @return array
     */
    public function getHashableAttributes()
    {
        return $this->hashableAttributes;
    }

    /*
     * Gets a code for when the user is
     * persisted to a cookie or session which
     * identifies the user.
     *
     * @return string
     */
    public function getPersistCode()
    {
        $this->persist_code = $this->getRandomString();

        // Our code got hashed
        $persistCode = $this->persist_code;

        $this->save();

        return $persistCode;
    }

    /*
     * Generate a random string.
     *
     * @return string
     */
    public function getRandomString($length = 42)
    {
        // We'll check if the user has OpenSSL installed with PHP. If they do
        // we'll use a better method of getting a random string. Otherwise, we'll
        // fallback to a reasonably reliable method.
        if (function_exists('openssl_random_pseudo_bytes')) {
            // We generate twice as many bytes here because we want to ensure we have
            // enough after we base64 encode it to get the length we need because we
            // take out the "/", "+", and "=" characters.
            $bytes = openssl_random_pseudo_bytes($length * 2);

            // We want to stop execution if the key fails because, well, that is bad.
            if ($bytes === false) {
                throw new \RuntimeException('Unable to generate random string.');
            }

            return substr(str_replace(array('/', '+', '='), '', base64_encode($bytes)), 0, $length);
        }

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    /*
     * Records a login for the user.
     *
     * @return void
     */
    public function recordLogin()
    {
        $this->date_last_active = $this->freshTimestamp();
        $this->setIpAddressAttribute( Request::getClientIp());
        $this->save();
    }

    /*
     * Check if the user is activated.
     *
     * @return bool
     */
    public function isActivated()
    {
        return (bool)$this->activated;
    }

    /*
     * Returns the user's login.
     *
     * @return mixed
     */
    public function getLogin()
    {
        return $this->{$this->getLoginName()};
    }

    /*
     * Checks the given persist code.
     *
     * @param  string  $persistCode
     * @return bool
     */
    public function checkPersistCode($persistCode)
    {
        if (!$persistCode) {
            return false;
        }

        return $persistCode === $this->persist_code;
    }

    /*
  * Check if the user is baned.
  *
  * @return bool
  */
    public function isBanned()
    {
        return (bool)$this->banned;
    }

    /*
     * Returns the user's ID.
     *
     * @return  mixed
     */
    public function getId()
    {
        return $this->getKey();
    }

    /**
     * See if the user is in the given group.
     *
     * @param  \Cartalyst\Sentry\Groups\GroupInterface  $group
     * @return bool
     */
    public function inGroup(Group $group)
    {
        foreach ($this->groups()->get() as $_group)
        {
            if ($_group->id == $group->id)
            {
                return true;
            }
        }

        return false;
    }
    /**
     * Adds the user to the given group.
     *
     * @param  \Cartalyst\Sentry\Groups\GroupInterface  $group
     * @return bool
     */
    public function addGroup(Group $group)
    {
        if ( ! $this->inGroup($group))
        {
            $this->groups()->attach($group);


        }

        return true;
    }

    public function removeGroup(Group $group)
    {
        if ($this->inGroup($group))
        {
            $this->groups()->detach($group);


        }

        return true;
    }

    /**
     * Set the ip address attribute.
     *
     * @param $ip
     * @return string
     */
    public function setIpAddressAttribute($ip)
    {
        $this->attributes['last_ip_address'] = inet_pton($ip);
    }


    /**
     * Get the ip address attribute.
     *
     * @param $ip
     * @return string
     */
    public function getIpAddressAttribute($ip)
    {
        return $ip ? inet_ntop($ip) : "";
    }

    public  function  getSeName()
    {
        return DB::table('url_record')->where('entity_id',$this->id)->where('entity_name','User')->where('is_active','1')->first()->slug;
    }


}
