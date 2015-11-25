<?php namespace Penst\Models\Setting;


use Penst\Models\BaseModel;

/**
 * Class Setting
 * @author Sefa Karagöz
 */
class Setting extends BaseModel {

    public $table = 'setting';

    protected $fillable = array('name', 'value');
}
