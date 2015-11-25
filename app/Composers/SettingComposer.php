<?php namespace Penst\Composers;

//use Frpsu\Models\Setting;
use Penst\Models\Setting\AppImformationSetting;
use Penst\Models\Setting\SeoSetting;
use Penst\Services\Setting\SettingServiceInterface;

/**
 * Class SettingComposer
 * @package Fully\Composers
 * @author Sefa Karagöz
 */
class SettingComposer {

    /**
     * @var \Fully\Repositories\Setting\SettingInterface
     */
    protected $setting;

    /**
     * @param SettingInterface $setting
     */
    public function __construct(SettingServiceInterface $setting) {

        $this->setting = $setting;
    }

    /**
     * @param $view
     */
    public function compose($view) {
        $appImformationsetting=new AppImformationSetting();
        $seoSetting=new SeoSetting();
        $appImformationsetting = $this->setting->loadSetting($appImformationsetting);
        $seoSetting = $this->setting->loadSetting($seoSetting);
        $view->with(array('appSetting'=>$appImformationsetting,'seoSetting'=>$seoSetting) );
    }
}