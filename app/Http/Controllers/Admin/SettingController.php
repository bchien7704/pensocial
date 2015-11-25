<?php namespace Penst\Http\Controllers\Admin;

use Penst\Http\Controllers\Controller;
use Penst\Models\Setting\AppImformationSetting;
use Penst\Models\Setting\CustomerSetting;
use Penst\Models\Setting\RegisterMethodEnum;
use Penst\Models\Setting\SeoSetting;
use Penst\Models\Setting\UserSetting;
use Penst\Services\Setting\SettingServiceInterface;
use Redirect;
use View;
use Input;
use Notification;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/8/15
 * Time: 3:17 PM
 */
class SettingController extends Controller
{
    protected $settingService;

    public function __construct(SettingServiceInterface $settingService)
    {
        $this->settingService = $settingService;
    }

    public function  generalSetting()
    {
        $appImformationSetting = new AppImformationSetting();
        $seoSetting=new SeoSetting();
        $setting = $this->settingService->loadSetting($appImformationSetting);
        $seoSettingView = $this->settingService->loadSetting($seoSetting);
        return view('backend.setting.generalsetting', compact('setting','seoSettingView'))->with('active', 'generalsetting');
    }

    public function  userSetting()
    {
        $userrSetting = new UserSetting();
        $registerMethod=RegisterMethodEnum::getConstants();
        $setting = $this->settingService->loadSetting($userrSetting);
        return view('backend.setting.usersetting', compact('setting','registerMethod'))->with('active', 'settings');
    }

    public  function  generalSettingSave()
    {
        $formData = Input::all();
        $appSetting=new AppImformationSetting();
        $seoSetting=new SeoSetting();
        $appSetting->facebookLink=$formData["facebookLink"];
        $appSetting->name=$formData["name"];
        $appSetting->twitterLink=$formData["twitterLink"];
        $appSetting->youtubeLink=$formData["youtubeLink"];
        $this->settingService->saveSetting($appSetting);
        $seoSetting->defaultTitle=$formData["defaultTitle"];
        $seoSetting->defaultMetaDescription=$formData["defaultMetaDescription"];
        $seoSetting->defaultMetaKeywords=$formData["defaultMetaKeywords"];
        $this->settingService->saveSetting($seoSetting);
        Notification::success('Settings was successfully updated');

        return Redirect::route('admin.setting.generalsetting');

    }
}