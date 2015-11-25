<?php namespace Penst\Http\Controllers\Admin;

use Penst\Http\Controllers\Controller;
use Penst\Models\Logging\ActivityLog;
use Penst\Models\Logging\ActivityLogType;
use Penst\Services\Logging\UserActivityServiceInterface;
use Datatable;
use Redirect;
use View;
use Input;
use Notification;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/10/15
 * Time: 10:51 AM
 */
class ActivityController extends Controller
{
    private $userActivityService;

    public function __construct(UserActivityServiceInterface $userActivityService)
    {
        $this->userActivityService = $userActivityService;
    }

    public function activityLogTypeIndex()
    {
        $table = $this->listActivityLogType();
        return view('backend.logging.activitytype', compact('table'));
    }

    public function activityLogIndex()
    {
        $table = $this->listActivityLog();
        return view('backend.logging.activitylog', compact('table'));
    }

    public function createActivityLogType()
    {
        $activityType = new ActivityLogType();
        return view('backend.logging.editactivitytype', compact('activityType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeActivityLogType() {

        try {

            $this->userActivityService->insertActivityLogType(Input::all());
            Notification::success('ActivityLogType was successfully added');
            return Redirect::Route('admin.activity.activitytype.index');
        } catch (ValidationException $e) {
            return Redirect::Route('admin.activity.activitytype.create')->withInput()->withErrors($e->getErrors());
        }
    }

    public function editActivityLogType($id)
    {
        $activityType = $this->userActivityService->getActivityLogTypeById($id);
        return view('backend.logging.editactivitytype', compact('activityType'));
    }

    public function updateActivityLogType($id)
    {
        try {
            $this->userActivityService->updateActivityLogType($id, Input::all());
            Notification::success('Activitytype was successfully updated');
            return Redirect::Route('admin.activity.activitytype.index');
        } catch (ValidationException $e) {

            return Redirect::Route('admin.activity.activitytype.edit')->withInput()->withErrors($e->getErrors());
        }
    }

    public function destroyActivityLogType($id)
    {
        try {
            $this->userActivityService->deleteActivityLogType($id);
            Notification::success('Activitytype was successfully delete');
            return Redirect::Route('admin.activity.activitytype.index');
        } catch (ValidationException $e) {

            return Redirect::Route('admin.activity.activitytype.index')->withInput()->withErrors($e->getErrors());
        }
    }

    public function destroyActivityLog($id)
    {
        try {
            $this->userActivityService->deleteActivityLog($id);
            Notification::success('Activity log was successfully delete');
            return Redirect::Route('admin.activity.activitylog.index');
        } catch (ValidationException $e) {

            return Redirect::Route('admin.activity.activitylog.index')->withInput()->withErrors($e->getErrors());
        }
    }

    /**
     * Create DataTable HTML
     *
     * @return mixed
     * @throws \Exception
     */
    private function listActivityLogType()
    {
        return Datatable::table()
            ->addColumn("System keyword", "Name", "Enabled")
            ->addColumn(trans('admin.ops.name'))
            ->setUrl(route('api.activity.listType'))
            ->render();
    }

    /**
     * Create DataTable HTML
     *
     * @return mixed
     * @throws \Exception
     */
    private function listActivityLog()
    {
        return Datatable::table()
            ->addColumn("Activity Log Type", "User ", "Message","Created on")
            ->addColumn(trans('admin.ops.name'))
            ->setUrl(route('api.activity.listLog'))
            ->render();
    }

    /**
     * JSON data for seeding Articles
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getActivityLogTypes()
    {
        return Datatable::collection(ActivityLogType::all())
            ->showColumns('system_keyword', 'name')
            ->addColumn('enabled', function ($model) {
                return render_checkbox($model->enabled);

            })
            ->addColumn('', function ($model) {
                return get_ops('activity.activitytype', $model->id);
            })
            ->searchColumns('system_keyword', 'name')
            ->orderColumns('system_keyword', 'name')
            ->make();
    }

    /**
     * JSON data for seeding Articles
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getActivityLogs()
    {
        $user=ActivityLog::all();
        return Datatable::collection(ActivityLog::all())
            ->addColumn('Activity Log Type', function($model)
            {
                return $model->activityLogType()->first()!=null? $model->activityLogType()->first()->name : "";
            })
            ->addColumn('User', function($model)
            {
                return $model->user()->first()!=null? $model->user()->first()->last_name:"";
            })
            ->showColumns("comment")
           ->addColumn('Created On', function ($model) {
               return $model->created_at;
            })
            ->addColumn('', function ($model) {
                return get_ops('activity.activitylog', $model->id);
            })
            ->searchColumns('comment')
            ->orderColumns('comment')
            ->make();
    }
}