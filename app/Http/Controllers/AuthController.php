<?php namespace Penst\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Penst\Cores\Exceptions\NoValidationRulesFoundException;
use Penst\Http\Controllers\Controller;
use Penst\Models\Message\EmailAccount;
use Penst\Services\Message\EmailSenderInterface;
use Penst\Services\Seo\UrlTrait;
use Penst\Services\Sercurity\PermissionServiceInterface;
use Penst\Services\Sercurity\StandardPermissionProvider;
use Penst\Services\User\UserServiceInterface;
use View;
use Input;
use Redirect;
use Auth;
use Notification;
use Validator;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins, UrlTrait;

    protected $userService;
    protected $user;
    protected $permissionService;
    protected $emailSender;


    public function __construct(UserServiceInterface $userService, PermissionServiceInterface $permissionService, EmailSenderInterface $emailSender)
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->userService = $userService;
        $this->permissionService = $permissionService;
        $this->emailSender = $emailSender;

    }

    /**
     * Display the login page
     * @return View
     */
    public function getLogin()
    {

        if (!Auth::check())
            return view('frontend.auth.sign_in');
        else {

            return Redirect::route('home');

        }

    }

    /**
     * Login action
     * @return Redirect
     */
    public function postLogin()
    {

        $credentials = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );

        $rememberMe = Input::get('rememberMe');

        try {

            Auth::attempt($credentials, $rememberMe);
            return Redirect::route('account.wall',array(Auth::user()->getSeName()));

        } catch (\Exception $e) {
            return Redirect::route('login')->withErrors(array('login' => $e->getMessage()));
        }
    }


    /**
     * Login action
     * @return Redirect
     */
    public function postRegister()
    {
        $formData = array(
            'full_name' => Input::get('full_name'),
            'username' => Input::get('username'),
            'email' => Input::get('email'),
            'password' => Input::get('password'),
            'confirm_password' => Input::get('confirm_password'),
            'gender' => Input::get('gender')
        );

        $rules = array(
            'full_name' => 'required|min:3',
            'username' => 'required|min:3|unique:user,username',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'gender' => 'required'
        );
        $messages = array(
            'required' => 'The :attribute is required.',
            'unique' => 'The :attribute has already .',
        );
        $validation = Validator::make($formData, $rules, $messages);
        if ($validation->fails()) {

            return Redirect::action('\Penst\Http\Controllers\HomeController@index')->withErrors($validation)->withInput();
        }
        try {

            $user = $this->userService->insertUser(array(
                'full_name' => $formData['full_name'],
                'username' => $formData['username'],
                'email' => $formData['email'],
                'password' => $formData['password'],
                'gender' => $formData['gender'] == "1" ? 'f' : 'm'
            ));

            $emailAccount = new EmailAccount();
            $email = $emailAccount->all()->first();
            $this->emailSender->sendEmail($email, "test", "test", "bchien7704@gmail.com", "hien", "buiconghien1988@gmail.com", "hau");
            $this->saveSlug($user, str_slug($user->full_name));
            Auth::login($user);
            return Redirect::route('login')->with("message", "dsdsdsada");

        } catch (\Exception $e) {
            return Redirect::route('login')->withErrors(array('login' => $e->getMessage()));
        }
    }

    /**
     * Logout action
     * @return Redirect
     */
    public function getLogout()
    {

        $this->userService->logOut();
        return Redirect::route('home');
    }

    public function getUserFlyOut()
    {
        return view('frontend.user.fly_out_user');
    }

    public function getNotificationFlyOut()
    {
        return view('frontend.user.fly_out_user');
    }

    public function getMessageFlyOut()
    {
        return view('frontend.user.fly_out_user');
    }
}
