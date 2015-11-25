<?php namespace Penst\Http\Controllers\Admin;

use Penst\Cores\Exceptions\ValidationException;
use Penst\Http\Controllers\Controller;
use Penst\Models\Message\EmailAccount;
use Penst\Models\Topic\Topic;
use Penst\Models\Us\User;
use Penst\Services\Message\EmailAccountServiceInterface;
use Penst\Services\Seo\UrlTrait;
use Penst\Services\Topic\TopicServiceInterface;
use Penst\Services\User\UserServiceInterface;
use View;
use Input;
use Redirect;
use Auth;
use Datatable;
use Notification;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/11/15
 * Time: 6:22 PM
 */
class UserController extends Controller
{
    use UrlTrait;
    private $userService;
    private  $groupService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $table = $this->listUser();
        return view('backend.user.index', compact('table'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

        $user = $this->userService->getById($id);
        $userGroups = $user->groups()->lists('name', 'id')->toArray();
        $groups =$this->userService->getAllGroup(false)->lists('name', 'id')->toArray();
        return view('backend.user.edit', compact('user','groups','userGroups'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

        try {

            $user=$this->userService->updateUser($id, Input::all());
            $slug=$this->validateSeName($user,"",$user->full_name,true);
            $this->saveSlug($user,$slug);
            $userGroups = $user->groups()->lists('name', 'id')->toArray();
            if(Input::has('groups')){
                foreach ($userGroups as $id=>$group ) {
                    if (!in_array($group, (array)Input::all()["groups"])) {
                        // Find the group using the group id
                        $adminGroup = $this->userService->getGroupById($id);
                        // Assign the group to the user
                        if ($user->removeGroup($adminGroup)) {
                            // Group assigned successfully
                        } else {
                            // Group was not assigned
                        }
                    }
                }
                foreach ((object)Input::all()["groups"] as $group => $id) {

                    // Find the group using the group id
                    $adminGroup =$this->userService->getGroupById($id);


                    // Assign the group to the user
                    if ($user->addGroup($adminGroup)) {
                        // Group assigned successfully
                    } else {
                        // Group was not assigned
                    }
                }

            }


            Notification::success('user was successfully updated');
            return Redirect::Route('admin.user.index');
        } catch (ValidationException $e) {

            return Redirect::Route('admin.user.edit',array('id'=>$id))->withInput()->withErrors($e->getMessage());
        }


    }


    /**
     * Create DataTable HTML
     *
     * @return mixed
     * @throws \Exception
     */
    private function listUser()
    {
        return Datatable::table()
            ->addColumn("Email", "Name ", "User roles", "Active", "Created on", "Last activity")
            ->addColumn(trans('admin.ops.name'))
            ->setUrl(route('api.user.list'))
            ->render();
    }

    /**
     * JSON data for seeding Articles
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getUsers()
    {
        return Datatable::collection(User::all())
            ->showColumns('email', 'full_name')
            ->addColumn('User roles', function ($model) {
                $userGroups = "";
                if ($model->groups() != null) {

                    foreach ($model->groups()->get() as $gr) {
                        $userGroups .=' '.$gr->name;
                    }

                }
                return $userGroups;


            })
            ->addColumn('Active', function ($model) {
                return render_checkbox($model->activated);

            })
            ->addColumn('Created On', function ($model) {
                return $model->created_at;
            })
            ->addColumn('Last activity', function ($model) {
                return $model->date_last_active;
            })
            ->addColumn('', function ($model) {
                return get_ops('user', $model->id);
            })
            ->searchColumns('email', 'full_name')
            ->orderColumns('email', 'full_name')
            ->make();
    }
}