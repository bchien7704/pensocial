<?php namespace Penst\Services\Setting;

use Penst\Cores\Cache\CacheInterface;
use Penst\Cores\Repositories\Setting\SettingRepositoryInterface;
use Penst\Models\Setting\BaseSetting;
use Penst\Models\Setting\Setting;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/8/15
 * Time: 11:18 AM
 */
class SettingService implements SettingServiceInterface
{

    protected $cache;
    private $settingRepository;
    private $SETTINGS_ALL_KEY = "Nop.setting.all";


    private $SETTINGS_PATTERN_KEY = "Nop.setting.";

    /**
     * @param ProjectInterface $project
     * @param CacheInterface $cache
     */
    public function __construct(SettingRepositoryInterface $settingRepository, CacheInterface $cache)
    {

        $this->settingRepository = $settingRepository;
        $this->cache = $cache;
    }

    function getSettingById($settingId)
    {
        // TODO: Implement getSettingById() method.
    }

    public function deleteSetting($id)
    {
        // TODO: Implement deleteSetting() method.
    }

    public function getSetting($key)
    {
        // TODO: Implement getSetting() method.
    }

    public function setSetting($key,$settingValue)
    {
       if(strlen($key)==0)
           throw new \Exception("Nnvalid key");
        $allSetting=$this->getAllSettings();
        if (count($allSetting->where("name", $key))>0) {
            $setting=$this->settingRepository->find($allSetting->where("name", $key)->first()->id);
            $setting->value=$settingValue;
            $setting->save();

        }
        else{
            $this->settingRepository->create(array('name'=>$key,'value'=>$settingValue));
        }

    }

    public function settingExists(Setting $setting)
    {
        // TODO: Implement settingExists() method.
    }

    public function  saveSetting(BaseSetting $setting)
    {
        $nameClass = class_basename($setting);
        $reflect = new \ReflectionClass($setting);
        $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);
        foreach ($props as $prop) {
            $key = $nameClass . '.' . $prop->name;
            $settingValue=$prop->getValue($setting);

            if ($settingValue != null)
                $this->setSetting(strtolower($key),$settingValue);
             else
                 $this->setSetting(strtolower($key),"");


        }
        $this->cache->forget( md5($this->SETTINGS_ALL_KEY));
        return $setting;
    }

    public function  loadSetting(BaseSetting $setting)
    {
        $nameClass = class_basename($setting);
        $reflect = new \ReflectionClass($setting);
        $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);
        foreach ($props as $prop) {
            $key = $nameClass . '.' . $prop->name;
            $settingValue = $this->getSettingByKey(strtolower($key));
            if ($settingValue == null)
                continue;
            $prop->setValue($setting, $settingValue);


        }
        return $setting;
    }

    public function getSettingByKey($key)
    {
        if (strlen($key) == 0)
            return null;
        $settings = $this->getAllSettings();
        $keyLower = strtolower($key);
        if (count($settings->where("name", $key))>0) {
            return $settings->where("name", $key)->first()->value;
        }
        return null;


    }

    public function getAllSettings()
    {
        $key = md5($this->SETTINGS_ALL_KEY);
        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }
        $query = $this->settingRepository->table()->newQuery();
        $query = $query->orderBy('name', 'desc');
        $settings = $query->get();
        $this->cache->put($key, $settings);
        return $settings;
    }
}
