<?php namespace Penst\Models\Seo;


use Penst\Models\BaseModel;

/**
 * Class Setting
 * @author Sefa Karagöz
 */
class UrlRecord extends BaseModel
{
    /*
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'url_record';

    protected $fillable = ['entity_id', 'entity_name', 'slug','is_active'];
}
