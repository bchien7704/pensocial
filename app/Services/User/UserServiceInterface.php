<?php namespace Penst\Services\User;
use Illuminate\Database\Eloquent\Model;
use Penst\Models\Us\Group;
use Penst\Models\Us\User;

/**
 * Interface SettingInterface
 * @package Fully\Repositories\Setting
 * @author Sefa Karagöz
 */
interface UserServiceInterface
{


    /**
     * @return mixed
     */
    public function  getById($id);

    public function authenticate(array $credentials, $remember = false);

    public function check($isCheckAdmin=false);

    public function logOut();

    public  function getUserForAutocomplete();

    public function getAllUser($createdFromUtc=null,$createdToUtc=null,$customerRoleIds=null,$email=null,$pageIndex=0,$pageSize=1000);

    public function getOnlineUser($lastActivityFromUtc=null,array $customerRoleIds = [],$email=null,$pageIndex=0,$pageSize=10000);

    public  function deleteUser($id);

    public  function  getUserById($id);

    public  function  getUserByIds(array $id=[]);

    public  function  getUserByEmail($email);

    public  function  getUserByFullName($fullName);

    public  function  insertUser($attributes);

    public  function  updateUser($id,$attributes);

    public  function  deleteGroup($id);

    public  function  insertGroup(Group $group);

    public  function  updateGroup(Group $group);

    public  function getGroupById($id);

    public function  getAllGroup($showHidden=false);




}