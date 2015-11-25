<?php namespace Penst\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/15/15
 * Time: 3:37 PM
 */
use DB;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Penst\Services\Message\MessageServiceInterface;
use Penst\Services\Seo\UrlTrait;
use Penst\Services\Topic\TopicServiceInterface;
use Penst\Services\User\UserServiceInterface;
use Redirect;

class TopicController extends Controller
{
    use UrlTrait;
    private $topicService;

    public function __construct(TopicServiceInterface $topicService)
    {
        $this->topicService = $topicService;
    }

    public function  topicBlock($systemName)
    {
        $topic = $this->topicService->getTopicBySystemName($systemName);
        if ($topic == null)
            return "";
        else
            return $topic;
        return view('frontend.topic.topic_detail', compact('topic'));

    }

    public function topicDetail($slug)
    {
        $topic = null;
        $idTopic = $this->getEntityIdBySeName($slug, 'Topic');
        if ($idTopic != null)
            $topic = $this->topicService->getTopicById($idTopic);
        return view('frontend.topic.topic_detail', compact('topic'));
    }
}