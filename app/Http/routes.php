<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Frontend Login
|--------------------------------------------------------------------------
*/
Route::get('/login', array(
    'as' => 'login',
    function () {

        return View::make('frontend.auth.sign_in');
    }));
/*
|--------------------------------------------------------------------------
| Backend Login
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', array(
    'as' => 'admin.login',
    function () {

        return View::make('backend/auth/login');
    }));

Route::group(array('namespace' => 'Admin'), function () {

    // admin auth
    Route::get('admin/logout', array('as' => 'admin.logout', 'uses' => 'AuthController@getLogout'));
    Route::get('admin/login', array('as' => 'admin.login', 'uses' => 'AuthController@getLogin'));
    Route::post('admin/login', array('as' => 'admin.login.post', 'uses' => 'AuthController@postLogin'));


});

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('getuserfly', array('as' => 'common.getuserfly', 'uses' => 'CommonController@getGetUserFly'));
Route::group(array('before' => array('before','confirmed')), function () {

    // frontend dashboard
    Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));

    // admin auth
    Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));
    Route::get('login', array('as' => 'login', 'uses' => 'AuthController@getLogin'));
    Route::post('login', array('as' => 'login.post', 'uses' => 'AuthController@postLogin'));
    Route::post('register', array('as' => 'register', 'uses' => 'AuthController@postRegister'));
    Route::get('password/email', array('as' => 'resetpassword.email', 'uses' => 'PasswordController@getEmail'));
    Route::post('password/email', array('as' => 'resetpassword.email', 'uses' => 'PasswordController@postEmail'));
    Route::get('password/reset/{token}', array('as' => 'resetpassword.reset', 'uses' => 'PasswordController@getReset'));
    Route::post('password/reset', array('as' => 'resetpassword.reset', 'uses' => 'PasswordController@postReset'));


});

Route::get('getuserfly', array('as' => 'common.getuserfly', 'uses' => 'CommonController@getGetUserFly'));

Route::group(array('middleware' => array('before','auth')), function () {

    Route::post('user/notification', array('as' => 'user.notification', 'uses' => 'UserController@getNotification'));
    Route::post('user/countnewnotification', array('as' => 'user.notification', 'uses' => 'UserController@getCountNewNotification'));
    Route::get('user/invitefriends', array('as' => 'user.invitefriend', 'uses' => 'UserController@getInviteFriend'));
    Route::get('user/searchallusers', array('as' => 'user.searchallusers', 'uses' => 'UserController@searchAllUser'));
    Route::get('message', array('as' => 'message', 'uses' => 'PrivateMessageController@index'));
    Route::post('message/sendmessage', array('as' => 'message.sendmessage', 'uses' => 'PrivateMessageController@sendMessage'));
    Route::post('message/messagereadunread', array('as' => 'message.messagereadunread', 'uses' => 'PrivateMessageController@setMessageReadUnread'));
    Route::post('message/messageremove', array('as' => 'message.messageremove', 'uses' => 'PrivateMessageController@setMessageRemove'));
    Route::get('message/{messageId}', array('as' => 'message.messagedetail', 'uses' => 'PrivateMessageController@messagedetail'));
    Route::post('message/reply', array('as' => 'message.reply', 'uses' => 'PrivateMessageController@replyMessage'));
    Route::get('user/settings', array('as' => 'user.setting', 'uses' => 'UserController@getSetting'));

    Route::post('/message/countnewmessage', array('as' => 'message.messagenotification', 'uses' => 'PrivateMessageController@getCountNewMessage'));
    /*  Common */
    Route::get('common/searchallautocomplete', array('as' => 'common.searchallautocomplete', 'uses' => 'CommonController@searchAllAutoComplete'));
    //Profile
    Route::get('user/edit-profile', array('as' => 'user.profile', 'uses' => 'UserController@getProfile'));
    //password
    Route::post('user/change-password', array('as' => 'user.changepassword', 'uses' => 'UserController@postChangePassword'));

   //wall

    Route::get('user/{slug}', array('as' => 'account.wall', 'uses' => 'WallController@wall'));

});
/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/

Route::group(array('prefix' => '/admin',
    'namespace' => 'Admin',
    'middleware' => array('auth.admin')), function () {

    // admin dashboard
    Route::get('/', ['as' => 'admin.root', 'uses' => 'DashboardController@index']);


    // settings
    Route::get('/setting/generalsetting', array('as' => 'admin.setting.generalsetting', 'uses' => 'SettingController@generalSetting'));

    Route::post('/setting/generalsetting', array('as' => 'admin.setting.generalsetting.save', 'uses' => 'SettingController@generalSettingSave'), array('before' => 'csrf'));

    // settings
    Route::get('/setting/usersetting', array('as' => 'admin.setting.usersetting', 'uses' => 'SettingController@userSetting'));

    //Logs
    Route::get('/log', array('as' => 'admin.system.log', 'uses' => 'LogViewerController@index'));




    // settings
    Route::get('activity/activitytype', array('as' => 'admin.activity.activitytype.index', 'uses' => 'ActivityController@activityLogTypeIndex'));
    Route::get('activity/activitytype/create', array('as' => 'admin.activity.activitytype.create', 'uses' => 'ActivityController@createActivityLogType'));
    Route::post('activity/activitytype/create', array('as' => 'admin.activity.activitytype.create', 'uses' => 'ActivityController@storeActivityLogType'));
    Route::get('api/activity/listtype', array('as' => 'api.activity.listType', 'uses' => 'ActivityController@getActivityLogTypes'));
    Route::get('activity/activitytype/edit/{id}', array('as' => 'admin.activity.activitytype.edit', 'uses' => 'ActivityController@editActivityLogType'))->where('id', '\d+');
    Route::post('activity/activitytype/edit/{id}', array('as' => 'admin.activity.activitytype.edit', 'uses' => 'ActivityController@updateActivityLogType'))->where('id', '\d+');
    Route::delete('activity/activitytype/destroy/{id}', array('as' => 'admin.activity.activitytype.destroy', 'uses' => 'ActivityController@destroyActivityLogType'))->where('id', '\d+');

    Route::get('activity/activitylog', array('as' => 'admin.activity.activitylog.index', 'uses' => 'ActivityController@activityLogIndex'));
    Route::get('api/activity/listlog', array('as' => 'api.activity.listLog', 'uses' => 'ActivityController@getActivityLogs'));
    Route::delete('activity/activitylog/destroy/{id}', array('as' => 'admin.activity.activitylog.destroy', 'uses' => 'ActivityController@destroyActivityLog'))->where('id', '\d+');
    //Email Account
    Route::resource('email-account', 'EmailAccountController');
    Route::get('api/emailaccount/list', array('as' => 'api.emailaccount.list', 'uses' => 'EmailAccountController@getEmailAccounts'));

    //Topic
    Route::resource('topic', 'TopicController');
    Route::get('api/topic/list', array('as' => 'api.topic.list', 'uses' => 'TopicController@getTopics'));
    Route::delete('/topic/destroy/{id}', array('as' => 'admin.topic.destroy', 'uses' => 'TopicController@destroy'))->where('id', '\d+');

    //Sercurty
    Route::get('/sercurity/permissions', array('as' => 'admin.security.permissions.index', 'uses' => 'SercurityController@permission'));
    Route::post('/sercurity/permissions', array('as' => 'admin.security.permissions.save', 'uses' => 'SercurityController@permissionSave'));

    //MessageTemplate
    Route::resource('messagetemplate', 'MessageTemplateController');
    Route::get('api/messagetemplate/list', array('as' => 'api.messagetemplate.list', 'uses' => 'MessageTemplateController@getMessageTemplates'));

    //User
    //Topic
    Route::resource('user', 'UserController');
    Route::get('api/user/list', array('as' => 'api.user.list', 'uses' => 'UserController@getUsers'));
    Route::delete('/user/destroy/{id}', array('as' => 'admin.user.destroy', 'uses' => 'UserController@destroy'))->where('id', '\d+');
});

//topic
Route::get('/{slug}', array('as' => 'topic.detail', 'uses' => 'TopicController@topicDetail'));