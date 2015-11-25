<?php namespace Penst\Models\Topic;


use Penst\Models\BaseModel;
use Penst\Services\Seo\UrlTrait;

/**
 * Class Setting
 * @author Sefa Karagöz
 */
class Topic extends BaseModel {
    use UrlTrait;

    public $table = 'topic';

    protected $fillable = array('system_name', 'include_stite_map','is_password', 'password','title', 'body','meta_keywords', 'meta_description','meta_title');

    public  function getSeName()
    {
//        Return this
    }
}
