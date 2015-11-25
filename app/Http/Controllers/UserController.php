<?php namespace Penst\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/15/15
 * Time: 3:37 PM
 */
use DB;
use Request;
use Hash;
use Auth;
use Input;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Session;
use Penst\Services\User\UserServiceInterface;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function  getNotification()
    {

        Session::set('last_verification', date('Y-m-d H:i:s'));
        $userIds = DB::select('CALL get_user_notification');
        $ids = array();
        foreach ($userIds as $id)

            array_push($ids, $id->user_id);

        $notification = DB::select('CALL get_notification(?)', array(Auth::user()->id));
        $users = $this->userService->getUserByIds($ids);
        if (count($notification) == 0)
            return '<div style="font-size: 11px; color: #333333; line-height: 80px; text-align: center;">No current notifications</div>';
        else
            return '<div style="font-size: 11px; color: #333333; line-height: 80px; text-align: center;">No current notifications</div>';


    }

    public function getCountNewNotification()
    {
        $dateLast = null;
        if (Session::has('last_verification')) {
            $dateLast = Session::get('last_verification');

        } else {
            Session::put('last_verification', date('Y-m-d H:i:s'));
            $dateLast = date('Y-m-d H:i:s');

        }
        $newNotification = DB::select('CALL count_new_notification(?,?)', array($dateLast, Auth::user()->id));
        $count = "";

    }

    public function  getSetting()
    {

        $selectTab = "";
        if (isset($_GET["tab"])) {
            $selectTab = $_GET["tab"];
        }
        return view('frontend.user.setting', compact('selectTab'));
    }

    public function  getInviteFriend()
    {
        return view('frontend.user.user_invite_friends');
    }

    public function searchAllUser()
    {
        $q = strtolower($_GET["term"]);
        if (!$q) return;
        $users = $this->userService->getUserForAutocomplete();
        foreach ($users as $item) {
            $link = 'professor/' . $item->item_id . '-' . parse_link($item->title);

            //$items[str_replace("'", "", (my_substr($row['title'], 50))) . ' [' . $row['mtype'] . ']'] = SITE_URL . $link;
            $items[$item->title] = 'localhost:8000/' . $link;
        }
        $result = array();
        foreach ($items as $key => $value) {
            if (strpos(strtolower($key), $q) !== false) {
                array_push($result, array("id" => $value, "label" => $key, "value" => strip_tags($key)));
            }
            if (count($result) > 11)
                break;
        }
        return array_to_json($result);


    }

    public function  getProfile()
    {
        $user = Auth::user();
        return view('frontend.user.edit_profile', compact('user'));
    }

    public function  postChangePassword()
    {
        $formData = array(

            'password' => Input::get('password'),
            'new_password' => Input::get('new_password'),
            'confirm_password' => Input::get('confirm_password'),

        );

        $rules = array(

            'password' => 'required|passcheck',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',

        );
        $messages = array(
            'required' => 'The :attribute is required.',
            'passcheck' => 'Your old password was incorrect'

        );
        Validator::extend('passcheck', function ($attribute, $value, $parameters) {
            if (Hash::check(Input::get('password'), Auth::user()->password)) {
                return true;
            } else {
                return false;
            };
        });
        $validation = Validator::make($formData, $rules, $messages);
        if ($validation->fails()) {

            return Redirect::back()->withErrors($validation)->withInput();
        }

        $user = $this->userService->getUserById(Auth::user()->id);
        $user->password = $formData['new_password'];
        $user->save();
        return Redirect::back()->with('success', true)->with('message', 'User updated.');


    }

    public  function postChangeSettingEmail()
    {

    }
}