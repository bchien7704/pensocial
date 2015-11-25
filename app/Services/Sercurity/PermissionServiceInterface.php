<?php namespace Penst\Services\Sercurity;

use Penst\Models\Sercurity\Permission;
use Penst\Models\Us\Group;
use Penst\Models\Us\User;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/6/15
 * Time: 9:32 AM
 */
Interface PermissionServiceInterface
{
    public function  deletePermissionRecord(Permission $permission);

    public function  getPermissionRecordById($id);

    public function  getPermissionRecordBySystemName($systemName);

    public function  getAllPermissionRecords();

    public function  getAllPermissionRecordBySystem($systemName);


    public function  insertPermissionRecord(Permission $permission);

    public function  updatePermissionRecord(Permission $permission);

    public function  authorize(Permission $permission);

    public function  authorizeUser(Permission $permission, User $user);

    public function  authorizeBySystemName($permissionRecordSystemName);

    public function  authorizeBySystemNameAndUser($permissionRecordSystemName,User $user);

    public function  authorizeBySystemNameAndGroup($permissionRecordSystemName,Group $group);
}