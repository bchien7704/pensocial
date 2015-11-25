<?php namespace Penst\Models\Setting;

use Penst\Cores\Entity\BasicEnum;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/9/15
 * Time: 10:48 AM
 */
abstract class RegisterMethodEnum extends BasicEnum
{
    const Standard = 0;
    const EmailValidation = 1;
    const  AdminApproval = 2;
    const  Disabled = 3;

}