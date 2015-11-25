<?php namespace Penst\Models\Sercurity;

use Penst\Models\BaseModel;

/**
 * Class Setting
 * @author Sefa Karagöz
 */
class Permission extends BaseModel
{
    /*
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permission';

    protected $fillable = ['name', 'system_name', 'category'];

    /* The Eloquent group model.
     *
     * @var string
     */
    protected static $groupModel = 'Penst\Models\Us\Group';

    /**
     * The user groups pivot table name.
     *
     * @var string
     */
    protected static $permissionGroupsPivot = 'permission_group';


    /**
     * Returns the relationship between groups and permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(static::$groupModel, static::$permissionGroupsPivot);
    }


}
