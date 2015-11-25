<?php namespace Penst\Services\Logging;
use Penst\Models\Us\User;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/10/15
 * Time: 8:51 AM
 */
interface UserActivityServiceInterface
{
    public function insertActivityLogType($attributes);

    public function updateActivityLogType($id, $attributes);

    public function deleteActivityLogType($d);

    public  function getAllActivityLogType();

    public function  getActivityLogTypeById($id);

    public function insertActivityLog($systemKeyword, $comment, array $commentParams );

    public function insertActivityLogWithUser($systemKeyword, $comment,User $user, array $commentParams );

    public function  getAllActivityTypesCached();

    public function allActivityTypeLog();

    public function deleteActivityLog($id);




}
