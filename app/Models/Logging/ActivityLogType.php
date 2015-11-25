<?php namespace Penst\Models\Logging;


use Penst\Models\BaseModel;

/**
 * Class Setting
 * @author Sefa Karagöz
 */
class ActivityLogType extends BaseModel
{
    /*
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activity_log_type';
    protected $fillable = array('system_keyword', 'name','enabled');
    public function activityLogs() {

        return $this->hasMany('Fully\Models\Logging\ActivityLog');
    }
}