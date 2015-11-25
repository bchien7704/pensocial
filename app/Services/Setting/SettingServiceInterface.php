<?php namespace Penst\Services\Setting;

use Penst\Models\Setting\BaseSetting;
use Penst\Models\Setting\Setting;

/**
 * Interface SettingInterface
 * @package Fully\Repositories\Setting
 * @author Sefa Karagöz
 */
interface SettingServiceInterface
{


    public function getSettingById($settingId);

    public function deleteSetting($id);

    public function getSetting($key);

    public function getSettingByKey($key);

    public function setSetting($key,$setting);

    public function getAllSettings();

    public function settingExists(Setting $setting);

    public function  saveSetting(BaseSetting $setting);

    public  function  loadSetting(BaseSetting $setting);


}