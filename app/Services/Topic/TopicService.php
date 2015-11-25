<?php namespace Penst\Services\Topic;


use Penst\Cores\Repositories\Message\MessageRepositoryInterface;

use DB;
use Paginator;
use Penst\Cores\Repositories\Topic\TopicRepositoryInterface;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/11/15
 * Time: 6:04 PM
 */
class TopicService implements TopicServiceInterface
{

    private $topicRepository;


    public function __construct(TopicRepositoryInterface $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }


    public function deleteTopic($id)
    {
      return $this->topicRepository->delete($id);
    }

    public function getTopicById($id)
    {
        return $this->topicRepository->find($id);
    }

    public function getTopicBySystemName($systemName)
    {
        // TODO: Implement getTopicBySystemName() method.
    }

    public function getAllTopics()
    {
        // TODO: Implement GetAllTopics() method.
    }

    public function insertTopic($attributes)
    {
       return $this->topicRepository->create($attributes);
    }

    public function updateTopic($id,$attributes)
    {
        return $this->topicRepository->update($id,$attributes);
    }
}