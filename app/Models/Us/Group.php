<?php namespace Penst\Models\Us;

use Penst\Models\BaseModel;

/**
 * Class Setting
 * @author Sefa Karagöz
 */
class Group extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'group';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * The Eloquent user model.
     *
     * @var string
     */
    protected static $userModel = 'Penst\Models\Us\User';

    /**
     * The Eloquent user model.
     *
     * @var string
     */
    protected static $permissionModel = 'Penst\Models\Sercurity\Permission';

    /**
     * The user groups pivot table name.
     *
     * @var string
     */
    protected static $userGroupsPivot = 'user_group';

    /**
     * The permission groups pivot table name.
     *
     * @var string
     */
    protected static $permissionGroupsPivot = 'permission_group';

    protected $validationRules = [
        'name' => 'required',
    ];

    /**
     * Returns the group's ID.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->getKey();
    }

    /**
     * Returns the group's name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the Eloquent model to use for user relationships.
     *
     * @param  string  $model
     * @return void
     */
    public static function setUserModel($model)
    {
        static::$userModel = $model;
    }

    /**
     * Set the user groups pivot table name.
     *
     * @param  string  $tableName
     * @return void
     */
    public static function setUserGroupsPivot($tableName)
    {
        static::$userGroupsPivot = $tableName;
    }
    /**
     * Set the Eloquent model to use for user relationships.
     *
     * @param  string  $model
     * @return void
     */
    public static function setPermissionModel($model)
    {
        static::$permissionModel = $model;
    }

    /**
     * Set the user groups pivot table name.
     *
     * @param  string  $tableName
     * @return void
     */
    public static function setPermissionGroupsPivot($tableName)
    {
        static::$permissionGroupsPivot = $tableName;
    }


    /**
     * Returns the relationship between groups and users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(static::$userModel, static::$userGroupsPivot);
    }

    /**
     * Returns the relationship between groups and permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(static::$permissionModel, static::$permissionGroupsPivot);
    }


}
