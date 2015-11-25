<?php namespace Penst\Http\Controllers\Admin;

use Penst\Cores\Exceptions\ValidationException;
use Penst\Http\Controllers\Controller;
use Penst\Models\Message\EmailAccount;
use Penst\Services\Message\EmailAccountServiceInterface;
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
class EmailAccountController extends Controller
{
    private $emailAccountService;

    public function __construct(EmailAccountServiceInterface $emailAccountService)
    {
        $this->emailAccountService = $emailAccountService;
    }

    public function index()
    {
        $table = $this->listEmailAccount();
        return view('backend.email.index', compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $emailAccount = new EmailAccount();
        return view('backend.email.create', compact('emailAccount'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

        $emailAccount = $this->emailAccountService->getEmailAccountById($id);
        return view('backend.email.edit', compact('emailAccount'));
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
            $this->emailAccountService->updateEmailAccount($id, Input::all());
            Notification::success('Email account was successfully updated');
            return Redirect::Route('admin.email-account.index');
        } catch (ValidationException $e) {

            return Redirect::Route('admin.activity.activitytype.edit')->withInput()->withErrors($e->getErrors());
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {


    }

    public  function  store()
    {
        try {

            $this->emailAccountService->insertEmailAccount(Input::all());
            Notification::success('Email account was successfully added');
            return Redirect::route('admin.email-account.index');
        } catch (ValidationException $e) {
            return Redirect::route('admin.email-account.create')->withInput()->withErrors($e->getErrors());
        }
    }

    /**
     * Create DataTable HTML
     *
     * @return mixed
     * @throws \Exception
     */
    private function listEmailAccount()
    {
        return Datatable::table()
            ->addColumn("Email address", "Email display name ", "Is default email account", "Created on")
            ->addColumn(trans('admin.ops.name'))
            ->setUrl(route('api.emailaccount.list'))
            ->render();
    }

    /**
     * JSON data for seeding Articles
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getEmailAccounts()
    {
        return Datatable::collection(EmailAccount::all())
            ->showColumns('email', 'display_name')
            ->addColumn('Is default email account', function ($model) {
                return render_checkbox($model->use_default_credentials);

            })
            ->addColumn('Created on', function ($model) {
                return $model->created_at;
            })
            ->addColumn('', function ($model) {
                return get_ops('email-account', $model->id);
            })
            ->searchColumns('email', 'display_name')
            ->orderColumns('email', 'display_name')
            ->make();
    }
}