<?php namespace Penst\Services\Sercurity;

use Penst\Cores\Cache\CacheInterface;
use Penst\Cores\Contexts\WorkContextInterface;
use Penst\Cores\Repositories\Sercurity\PermissionRepositoryInterface;
use Penst\Models\Sercurity\Permission;
use Penst\Models\Us\Group;
use Penst\Models\Us\User;
use Auth;


/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/6/15
 * Time: 9:32 AM
 */
class PermissionService implements PermissionServiceInterface
{
    private $cache;
    private $permissionRepository;
    private $workContext;

    public function __construct(PermissionRepositoryInterface $permissionRepository, CacheInterface $cache, WorkContextInterface $workContext)
    {
        $this->permissionRepository = $permissionRepository;
        $this->cache = $cache;
        $this->workContext = $workContext;

    }

    public function  deletePermissionRecord(Permission $permission)
    {
        // TODO: Implement deletePermissionRecord() method.
    }

    public function  getPermissionRecordById($id)
    {
        // TODO: Implement getPermissionRecordById() method.
    }

    public function  getPermissionRecordBySystemName($systemName)
    {
        // TODO: Implement getPermissionRecordBySystemName() method.
    }

    public function  getAllPermissionRecordBySystem($systemName)
    {
        // TODO: Implement getAllPermissionRecords() method.
    }

    public function  getAllPermissionRecords()
    {
       return $this->permissionRepository->all();
    }

    public function  insertPermissionRecord(Permission $permission)
    {
        // TODO: Implement insertPermissionRecord() method.
    }

    public function  updatePermissionRecord(Permission $permission)
    {
        // TODO: Implement updatePermissionRecord() method.
    }

    public function  authorize(Permission $permission)
    {
        return $this->authorizeUser($permission, Auth::user());
    }

    public function  authorizeUser(Permission $permission, User $user)
    {
        if ($permission == null)
            return false;
        if ($user == null)
            return false;
        return $this->authorizeBySystemNameAndUser($permission->system_name, $user);

    }

    public function  authorizeBySystemName($permissionRecordSystemName)
    {
        // TODO: Implement authorizeBySystemName() method.
    }


    public function  authorizeBySystemNameAndUser($permissionRecordSystemName, User $user)
    {
        if (strlen($permissionRecordSystemName) == 0)
            return false;
        $customerGroup = $user->groups()->where('active', '1')->get();
        foreach ($customerGroup as $item)
            if ($this->authorizeBySystemNameAndGroup($permissionRecordSystemName, $item))
                return true;
        return false;


    }

    public function  authorizeBySystemNameAndGroup($permissionRecordSystemName, Group $group)
    {
        if (strlen($permissionRecordSystemName) == 0)
            return false;
        $permissions=$group->permissions()->get();
        foreach ($permissions as $item)
            if ($item->system_name == $permissionRecordSystemName)
                return true;
        return false;
    }
}