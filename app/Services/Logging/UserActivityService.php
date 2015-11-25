<?php namespace Penst\Services\Logging;

use Illuminate\Support\Facades\Auth;
use Penst\Cores\Cache\CacheInterface;
use Penst\Cores\Repositories\Logging\ActivityLogRepository;
use Penst\Cores\Repositories\Logging\ActivityLogRepositoryInterface;
use Penst\Cores\Repositories\Logging\ActivityLogTypeRepository;
use Penst\Cores\Repositories\Logging\ActivityLogTypeRepositoryInterface;
use Penst\Models\Us\User;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/10/15
 * Time: 8:51 AM
 */
class UserActivityService implements UserActivityServiceInterface
{
    private $activityLogRepository;
    private $activityLogTypeRepository;
    private $cache;
    private $ACTIVITYTYPE_ALL_KEY = "Penst.activitytype.all";

    public function __construct(ActivityLogRepositoryInterface $activityLogRepository, ActivityLogTypeRepositoryInterface $activityLogTypeRepository, CacheInterface $cache)
    {
        $this->activityLogRepository = $activityLogRepository;
        $this->cache = $cache;
        $this->activityLogTypeRepository = $activityLogTypeRepository;
    }

    public function insertActivityLogType($attributes)
    {
      $this->activityLogTypeRepository->create($attributes);
    }

    public function updateActivityLogType($id, $attributes)
    {
        $this->activityLogTypeRepository->update($id,$attributes);
    }

    public function deleteActivityLogType($id)
    {
       $this->activityLogTypeRepository->delete($id);
    }

    public function deleteActivityLog($id)
    {
        $this->activityLogRepository->delete($id);
    }

    public function getAllActivityLogType()
    {
        // TODO: Implement getAllActivityLogType() method.
    }

    public function  getActivityLogTypeById($id)
    {
        return $this->activityLogTypeRepository->find($id);
    }

    public function insertActivityLog($systemKeyword, $comment, array $commentParams)
    {
        $this->insertActivityLogWithUser($systemKeyword, Auth::user(), $comment, $commentParams);

    }

    public function insertActivityLogWithUser($systemKeyword, $comment, User $user, array $commentParams)
    {
        if ($user == null)
            return null;
        $activityTypes = $this->getAllActivityLogType();
        $activityType=$activityTypes->where('system_name',$systemKeyword)->first();
        if($activityType==null && !$activityType->enabled)
            return null;
        $comment=vsprintf($comment,$commentParams);
        $this->activityLogRepository->table()->create(array("activity_log_type_id",$activityType->id,"	user_id"=>$user->id,"comment"=>$comment));



    }

    public function  getAllActivityTypesCached()
    {

        $key = md5($this->ACTIVITYTYPE_ALL_KEY);
        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }
        $query = $this->activityLogTypeRepository->table()->newQuery();
        $query = $query->orderBy('system_keyword', 'desc');
        $activityTypes = $query->get();
        $this->cache->put($key, $activityTypes);
        return $activityTypes;
    }

    public  function  allActivityTypeLog()
    {
        $this->activityLogTypeRepository->all();
}
}