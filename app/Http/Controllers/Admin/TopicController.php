<?php namespace Penst\Http\Controllers\Admin;

use Penst\Cores\Exceptions\ValidationException;
use Penst\Http\Controllers\Controller;
use Penst\Models\Message\EmailAccount;
use Penst\Models\Topic\Topic;
use Penst\Services\Message\EmailAccountServiceInterface;
use Penst\Services\Seo\UrlTrait;
use Penst\Services\Topic\TopicServiceInterface;
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
class TopicController extends Controller
{
    use UrlTrait;
    private $topicService;

    public function __construct(TopicServiceInterface $topicService)
    {
        $this->topicService = $topicService;
    }

    public function index()
    {
        $table = $this->listTopict();
        return view('backend.email.index', compact('table'));
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
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id) {
        try {
        $this->topicService->deleteTopic($id);
        Notification::success('Topic was successfully deleted');
            return Redirect::Route('admin.topic.index');
        } catch (ValidationException $e) {

            return Redirect::Route('admin.topic.edit')->withInput()->withErrors($e->getErrors());
        }
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
    private function listTopict()
    {
        return Datatable::table()
            ->addColumn("System name", "Password protected ", "Include in sitemap")
            ->addColumn(trans('admin.ops.name'))
            ->setUrl(route('api.topic.list'))
            ->render();
    }

    /**
     * JSON data for seeding Articles
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getTopics()
    {
        return Datatable::collection(Topic::all())
            ->showColumns('system_name')
            ->addColumn('Password protected', function ($model) {
                return render_checkbox($model->is_password);

            })
            ->addColumn('Include in sitemap', function ($model) {
                return render_checkbox($model->include_stite_map);

            })
            ->addColumn('', function ($model) {
                return get_ops('topic', $model->id);
            })
            ->searchColumns('system_name', 'title')
            ->orderColumns('system_name')
            ->make();
    }

}
