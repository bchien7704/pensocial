<?php namespace Penst\Services\Message;
/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/11/15
 * Time: 6:04 PM
 */


Interface  EmailAccountServiceInterface
{
    public function  insertEmailAccount($attributes);

    public function  updateEmailAccount($id, $attributes);

    public function  deleteEmailAccount($id);

    public function  getEmailAccountById($id);

    public function  getAllEmailAccounts();


}