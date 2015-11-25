<?php namespace Penst\Services\Topic;
/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/11/15
 * Time: 6:04 PM
 */


Interface  TopicServiceInterface
{
    public function deleteTopic($id);

    public function getTopicById($id);

    public function getTopicBySystemName($systemName);

    public function getAllTopics();

    public function insertTopic($attributes);

    public function updateTopic($id,$attributes);


}