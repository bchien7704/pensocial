<?php namespace Penst\Http\Controllers\Admin;

use Penst\Cores\Exceptions\ValidationException;
use Penst\Http\Controllers\Controller;
use Penst\Models\Message\EmailAccount;
use Penst\Models\Message\MessageTemplate;
use Penst\Services\Message\EmailAccountServiceInterface;
use Penst\Services\Message\MessageTemplateServiceInterface;
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
class MessageTemplateController extends Controller
{
    private $messageTemplateService;

    public function __construct(MessageTemplateServiceInterface $messageTemplateService)
    {
        $this->messageTemplateService = $messageTemplateService;
    }

    public function index()
    {
        $table = $this->listMessageTemplate();
        return view('backend.message_template.index', compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $topic = new Topic();
        return view('backend.topic.create', compact('topic'));

    }

    public  function  store()
    {
        try {

            $topic=$this->topicService->insertTopic(Input::all());
            $slug=$this->validateSeName($topic,"",$topic->system_name,true);
            $this->saveSlug($topic,$slug);
            Notification::success('Topic account was successfully added');
            return Redirect::route('admin.topic.index');
        } catch (ValidationException $e) {
            return Redirect::route('admin.topic.create')->withInput()->withErrors($e->getErrors());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

        $topic = $this->topicService->getTopicById($id);
        return view('backend.topic.edit', compact('topic'));
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
            $topic=$this->topicService->updateTopic($id, Input::all());
            $slug=$this->validateSeName($topic,"",$topic->system_name,true);
            $this->saveSlug($topic,$slug);
            Notification::success('Topic was successfully updated');
            return Redirect::Route('admin.topic.index');
        } catch (ValidationException $e) {

            return Redirect::Route('admin.topic.edit')->withInput()->withErrors($e->getErrors());
        }


    }

    /**
     * Create DataTable HTML
     *
     * @return mixed
     * @throws \Exception
     */
    private function listMessageTemplate()
    {
        return Datatable::table()
            ->addColumn("Name", "Subject ", "Is active")
            ->addColumn(trans('admin.ops.name'))
            ->setUrl(route('api.messagetemplate.list'))
            ->render();
    }

    /**
     * JSON data for seeding Articles
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getMessageTemplates()
    {
        return Datatable::collection(MessageTemplate::all())
            ->showColumns('name','subject')

            ->addColumn('Is active', function ($model) {
                return render_checkbox($model->is_active);

            })
            ->addColumn('', function ($model) {
                return get_ops('messagetemplate', $model->id);
            })
            ->searchColumns('name', 'subject')
            ->orderColumns('name','subject')
            ->make();
    }

}