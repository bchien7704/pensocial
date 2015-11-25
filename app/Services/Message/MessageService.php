<?php namespace Penst\Services\Message;


use Penst\Cores\Repositories\Message\MessageRepositoryInterface;

use DB;
use Paginator;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/11/15
 * Time: 6:04 PM
 */
class MessageService implements MessageServiceInterface
{

    private $messageRepository;


    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function  getSendMessage($user_id, $item, $noChangePage = false)
    {

        $message = DB::table('messages')
            ->join('user', 'messages.to_id', '=', 'user.id')
            ->where('messages.from_id', '=', $user_id)
            ->where('messages.to_deleted', '=', 0)
            ->where('messages.reply_to', '=', 0)
            ->where('messages.subject', 'LIKE', '%' . $item . '%')
            ->select('messages.subject', 'messages.id', 'messages.content', 'messages.to_id', 'messages.from_id', 'messages.read', 'messages.created_at', DB::raw('NOW() - UNIX_TIMESTAMP(messages.created_at) as time'), 'user.id as user_id', 'user.last_name', "user.first_name", "user.full_name", 'user.photo', 'user.online')
            ->paginate(5);

        return $message;

    }

    public function  getMessage($user_id, $item, $noChangePage = false)
    {

        $message = DB::table('messages')
            ->join('user', 'messages.from_id', '=', 'user.id')
            ->where('messages.to_id', '=', $user_id)
            ->where('messages.to_deleted', '=', 0)
            ->where('messages.reply_to', '=', 0)
            ->where('messages.subject', 'LIKE', '%' . $item . '%')
            ->select('messages.subject', 'messages.id', 'messages.content', 'messages.to_id', 'messages.from_id', 'messages.read', 'messages.created_at', DB::raw('NOW() - UNIX_TIMESTAMP(messages.created_at) as time'), 'user.id as user_id', 'user.last_name', "user.first_name", "user.full_name", 'user.photo', 'user.online')
            ->paginate(5);
        return $message;
    }

    public function  insertMessage($attributes)
    {
        return $this->messageRepository->create($attributes);
    }

    public function  updateMessage($id, $attributes)
    {
        return $this->messageRepository->update($id, $attributes);
    }

    public function deleteMessage($id)
    {
        return $this->messageRepository->delete($id);
    }

    public function  getMessageById($id)
    {
        return $this->messageRepository->find($id);
    }

    public function  getMessageByIdAndToId($id, $toId)
    {
        return $this->messageRepository->table()->query()->where('id', $id)->where('to_id', $toId)->first();
    }

    public function getDetailMessage($ow, $id, $userId)
    {
        $message = DB::table('messages')
            ->join('user', 'messages.' . $ow . '', '=', 'user.id')
            ->where('messages.reply_to', '=', 0)
            ->where('messages.id', '=', $id)
            ->where(function ($query) use ($userId) {
                $query->where('messages.from_id', '=', $userId)
                    ->orWhere('messages.to_id', '=', $userId);
            })
            ->select('messages.subject', 'messages.read_reply', 'messages.id', 'messages.content', 'messages.to_id', 'messages.from_id', 'messages.read', 'messages.created_at', DB::raw('NOW() - UNIX_TIMESTAMP(messages.created_at) as time'), 'user.id as user_id', 'user.last_name', "user.first_name", "user.full_name", 'user.photo', 'user.online')
            ->first();
        return $message;
    }

    public function getReplyMessage($ow, $id, $userId, $item)
    {
        $message = DB::table('messages')
            ->join('user', 'messages.' . $ow . '', '=', 'user.id')
            ->where('messages.reply_to', '=', $id)
            ->where('messages.content', 'LIKE', '%' . $item . '%')
            ->where(function ($query) use ($userId) {
                $query->where('messages.from_id', '=', $userId)
                    ->orWhere('messages.to_id', '=', $userId);
            })
            ->select('messages.subject', 'messages.id', 'messages.read_reply', 'messages.content', 'messages.reply_to', 'messages.to_id', 'messages.from_id', 'messages.read', 'messages.created_at', DB::raw('NOW() - UNIX_TIMESTAMP(messages.created_at) as time'), 'user.id as user_id', 'user.last_name', "user.first_name", "user.full_name", 'user.photo', 'user.online')
            ->get();
        return $message;
    }

    public function  getMessageByIdAndUser($id, $userId)
    {
        return $this->messageRepository->table()->query()->where('id', $id)->where('to_id', $userId)->first();
    }

    public function  getMessageByFromAndReply($fromId, $replyId)
    {
        return $this->messageRepository->table()->query()->where('from_id', $fromId)->where('reply_to', $replyId)->get();
    }

    public function  getDeleteForUser($id, array $column, $userId)
    {
        return $this->messageRepository->table()->query()->where('id', $id)->where($column[1], $userId)->first();
    }

    public function  deleteWhereAction($deleteAll = false, array $action, $id, $userId)
    {
        $messageDelete = $this->messageRepository->table()->query()->where('id', $id)->where($action[1], $userId)->first();
        if ($messageDelete != null) {
            if ($deleteAll) {
                $this->deleteMessage($messageDelete->id);
            } else {
                $messageDelete->$action[2] = 1;
                $messageDelete->save();
            }
        }
    }

    public  function  getNewReplyMessage($id,$userId)
    {
        $nr = DB::table('messages')
            ->join('user', 'messages.from_id', '=', 'user.id')
            ->where('messages.from_id', '=', $userId)
            ->where('messages.to_deleted', '=', 0)
            ->where('messages.reply_to', '=', $id)
            ->where('messages.read_reply', '=', 0)
            ->count();
        return  $nr;
    }

    public  function  getCountNewMessage($userId)
    {
        $nr = DB::table('messages')
            ->join('user', 'messages.from_id', '=', 'user.id')
            ->where('messages.to_id', '=', $userId)
            ->where('messages.to_deleted', '=', 0)
            ->where('messages.reply_to', '=', 0)
            ->where('messages.read_reply', '=', 0)
            ->count();
        return  $nr;
    }


}