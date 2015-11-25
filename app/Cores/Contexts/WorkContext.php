<?php namespace Penst\Cores\Contexts;

use Penst\Cores\Cookies\CookieInterface;
use Penst\Models\Us\User;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/6/15
 * Time: 10:02 AM
 */
class WorkContext implements WorkContextInterface
{

    private $cacheUser;

    public function __construct()
    {


    }

    public function  getCurrentUser()
    {
        if ($this->cacheUser != null)
            return User($this->cacheUser);
        else
            return null;
    }

    public function  setCurrentUser(User $user)
    {
        $this->cacheUser = $user;
    }


}



