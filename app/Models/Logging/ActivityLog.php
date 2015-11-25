<?php namespace Penst\Models\Logging;


use Penst\Models\BaseModel;

/**
 * Class Setting
 * @author Sefa Karagöz
 */
class ActivityLog extends BaseModel
{
    /*
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activity_log';

    /**
     * The Eloquent group model.
     *
     * @var string
     */
    protected static $activityLogTypeModel = 'Penst\Models\Logging\ActivityLogType';

    /**
     * Set the Eloquent model to use for group relationships.
     *
     * @param  string $model
     * @return void
     */
    public static function setActivityLogTypeModel($model)
    {
        static::$activityLogTypeModel = $model;
    }
    /**
     * The Eloquent user model.
     *
     * @var string
     */
    protected static $userModel = 'Penst\Models\Us\User';

    /**
     * Set the Eloquent model to use for group relationships.
     *
     * @param  string $model
     * @return void
     */
    public static function setUserModel($model)
    {
        static::$userModel = $model;
    }

    public function activityLogType() {

        return $this->hasOne(static::$activityLogTypeModel,"id","activity_log_type_id");
    }
    public function user() {

        return $this->hasOne(static::$userModel,"id","user_id");

    }

}