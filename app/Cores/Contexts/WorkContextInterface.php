<?php namespace Penst\Cores\Contexts;

use Penst\Models\Us\User;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/6/15
 * Time: 8:57 AM
 */
interface WorkContextInterface
{
    public function  getCurrentUser();

    public function  setCurrentUser(User $user);
}