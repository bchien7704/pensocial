<?php namespace Penst\Http\Controllers\Admin;

use Penst\Http\Controllers\Controller;
use Penst\Models\Sercurity\permissionModelView;
use Penst\Services\Sercurity\PermissionServiceInterface;
use Penst\Services\Sercurity\StandardPermissionProvider;
use Penst\Services\User\UserServiceInterface;
use Redirect;
use View;
use Input;
use Notification;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/12/15
 * Time: 4:22 PM
 */
class SercurityController extends Controller
{
    private $permissionService;
    private $standardPermissionProvider;
    private $userService;

    public function __construct(PermissionServiceInterface $permissionService, UserServiceInterface $userService)
    {
        $this->permissionService = $permissionService;
        $this->standardPermissionProvider = new StandardPermissionProvider();
        $this->userService = $userService;

    }

    public function  permission()
    {
        if (!$this->permissionService->authorize($this->standardPermissionProvider->accessAdminPanel))
            return false;
        $permissionModelView = new permissionModelView();
        $permissionRecords = $this->permissionService->getAllPermissionRecords();
        $userGroup = $this->userService->getAllGroup();
        $permissionModelView->availablePermissions = $permissionRecords->toArray();
        $permissionModelView->availableUserGroup = $userGroup->toArray();
        foreach ($permissionRecords as $per)
            foreach ($userGroup as $group) {
                $allow = $per->groups()->where("id", $group->id)->count() > 0;
                $arrayAllowed = array($permissionModelView->allowed);
                if (array_key_exists($per->system_name, $arrayAllowed))
                    $permissionModelView[$per->system_name] = array();
                $permissionModelView->allowed[$per->system_name][$group->id] = $allow;
                $alowwed = (array_key_exists($per["system_name"], $permissionModelView->allowed) && $permissionModelView->allowed[$per["system_name"]][$group["id"]]);

            }

        return view('backend.sercurity.permission', compact('permissionModelView'));

    }

    public function  permissionSave()
    {

        if (!$this->permissionService->authorize($this->standardPermissionProvider->accessAdminPanel))
            return false;
        try {
            $permissionRecords = $this->permissionService->getAllPermissionRecords();
            $userGroup = $this->userService->getAllGroup();
            $formData = Input::all();
            foreach ($userGroup as $gruop) {
                $formKey = "allow_" . $gruop->id;
                $permissionRecordSystemNamesToRestrict = array();
                if (array_key_exists($formKey, $formData))
                    $permissionRecordSystemNamesToRestrict = array_flip($formData[$formKey]);
                foreach ($permissionRecords as $per) {
                    $allow = array_key_exists($per->system_name, $permissionRecordSystemNamesToRestrict);
                    if ($allow) {
                        if ($per->groups->where("id", $gruop->id)->first() == null) {
                            $per->groups()->attach($gruop);
                        }
                    } else {
                        if ($per->groups->where("id", $gruop->id)->first() != null) {
                            $per->groups()->detach($gruop);
                        }
                    }
                }

            }
            return Redirect::route('admin.security.permissions.index');
        } catch (ValidationException $e) {

            return Redirect::Route('admin.activity.activitytype.edit')->withInput()->withErrors($e->getErrors());
        }

    }

}