<?php namespace Penst\Services\Message;
/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/11/15
 * Time: 6:04 PM
 */


Interface  MessageServiceInterface
{
    public function  getSendMessage($user_id, $item, $noChangePage = false);

    public function  getMessage($user_id, $item, $noChangePage = false);

    public function getDetailMessage($ow, $id, $userId);

    public function getReplyMessage($ow, $id, $userId, $item);

    public function  insertMessage($attributes);

    public function  updateMessage($id, $attributes);

    public function deleteMessage($id);

    public function  getMessageById($id);

    public function  getMessageByIdAndToId($id, $toId);

    public function  getMessageByIdAndUser($id, $userId);

    public function  getMessageByFromAndReply($fromId, $replyId);

    public function  getDeleteForUser($id, array $column, $userId);

    public function  deleteWhereAction($deleteAll = false, array $action, $id, $userId);

    public function  getNewReplyMessage($id, $userId);


    public function  getCountNewMessage($userId);


}