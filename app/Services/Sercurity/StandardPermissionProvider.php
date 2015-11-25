<?php namespace Penst\Services\Sercurity;

use Penst\Models\Sercurity\Permission;


/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/6/15
 * Time: 10:51 AM
 */
class StandardPermissionProvider implements PermissionProviderInterface
{
    public $accessAdminPanel;

    public $allowCustomerImpersonation;

    public function  __construct()

    {

        $this->accessAdminPanel = new Permission(array('name' => 'Access admin area', 'system_name' => 'AccessAdminPanel', 'category' => 'Standard'));
        $this->allowCustomerImpersonation = new Permission(array('Admin area. Allow Customer Impersonation', 'system_name' => 'AllowCustomerImpersonationl', 'category' => 'Customers'));

    }

}