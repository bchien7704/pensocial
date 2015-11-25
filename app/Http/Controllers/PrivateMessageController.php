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
use Penst\Services\User\UserServiceInterface;
use Redirect;

class PrivateMessageController extends Controller
{
    private $messageService;
    private $userService;

    public function __construct(MessageServiceInterface $messageService, UserServiceInterface $userService)
    {
        $this->messageService = $messageService;
        $this->userService = $userService;
    }

    public function  index()
    {
        $item = "";
        $option = "";
        if (Input::has("item")) {
            $item = Input::all()["item"];

        }

        if (Input::has("option")) {
            $option = Input::all()["option"];

        }
        $sendMessages = null;
        $messages = null;
        if (strlen($option) != 0 && $option == "send-message") {
            $sendMessages = $this->messageService->getSendMessage(Auth::user()->id, $item);
            if ($sendMessages != null) {
                $countReplyMessage = array();
                foreach ($sendMessages as $ms) {
                    array_push($countReplyMessage, $this->messageService->getNewReplyMessage($ms->id, Auth::user()->id));
                }
            }
            return view('frontend.message.send_message', compact('sendMessages', 'countReplyMessage'));
        } elseif (strlen($option) != 0 && $option == "message") {
            $messages = $this->messageService->getMessage(Auth::user()->id, $item);
            if ($messages != null) {
                $countReplyMessage = array();
                foreach ($messages as $ms) {
                    array_push($countReplyMessage, $this->messageService->getNewReplyMessage($ms->id, Auth::user()->id));
                }
            }

            return view('frontend.message.message', compact('messages','countReplyMessage'));
        } else {
            $messages = $this->messageService->getMessage(Auth::user()->id, $item);
            if ($messages != null) {
                $countReplyMessage = array();
                foreach ($messages as $ms) {
                    array_push($countReplyMessage, $this->messageService->getNewReplyMessage($ms->id, Auth::user()->id));
                }
            }
            return view('frontend.message.message', compact('messages','countReplyMessage'));
        }
    }

    public function sendMessage()
    {
        $formData = Input::all();
        $toUser = $this->userService->getUserByFullName($formData['to']);
        $notificcation = "";
        if ($toUser != null) {
            try {
                $this->messageService->insertMessage(array('from_id' => Auth::user()->id, 'to_id' => $toUser->id, 'subject' => $formData['subject'], 'content' => $formData['message']));
                $notificcation = "Message was succesfully sent";
                return $notificcation;
            } catch (\Exception $e) {
                $notificcation = $e->getMessage();
                return $notificcation;
            }
        }
    }

    public function  setMessageReadUnread()
    {
        $formData = Input::all();
        $id = $formData["messageId"];
        $message = $this->messageService->getMessageByIdAndToId($id, Auth::user()->id);
        $notificcation = "";
        if ($message != null) {
            try {
                $message->read = 0;
                $message->save();
                $notificcation = "Message was mark unread";
                return $notificcation;

            } catch (\Exception $e) {
                $notificcation = $e->getMessage();
                return $notificcation;
            }
        }

    }

    public function  setMessageRemove()
    {
        if (Input::has('id')) {
            $id = Input::all()["id"];
        }
        if ($id > 0) {
            $message = $this->messageService->getMessageByIdAndToId($id, Auth::user()->id);
            $from_me = array('from_deleted', 'to_id', 'to_deleted');
            $to_me = array('to_deleted', 'from_id', 'from_deleted');
            $action = Input::get('me') == 'true' ? $from_me : $to_me;
            $notificcation = "";
            if ($message != null) {
                try {
                    if ($this->messageService->getDeleteForUser($id, $action, Auth::user()->id) != null) {
                        $mesageDelete = $this->messageService->getMessageByIdAndToId($id, Auth::user()->id);
                        if ($mesageDelete != null)
                            $this->messageService->deleteWhereAction(true, $action, $mesageDelete->id, Auth::user()->id);
                        else
                            $this->messageService->deleteWhereAction(false, $action, $mesageDelete->id, Auth::user()->id);
                    }
                    $notificcation = "Message was remove";
                    return $notificcation;

                } catch (\Exception $e) {
                    $notificcation = $e->getMessage();
                    return $notificcation;
                }
            }
        }

    }

    public function  messageDetail($messageId)
    {
        $id = base64_decode($messageId);
        $message = $this->messageService->getMessageById($id);
        if ($message != null) {
            $ex = 'from_id';
            $me = 'to_id';
        } else {
            $ex = 'to_id';
            $me = 'from_id';
        }
        $item = "";
        if (Input::has("item")) {
            $item = Input::all()["item"];

        }
        $messageDetail = $this->messageService->getDetailMessage($ex, $id, Auth::user()->id);
        $replyMessages = $this->messageService->getReplyMessage($me, $id, Auth::user()->id, $item);
        if ($messageDetail != null && $messageDetail->read == 0) {
            $messageUpdate = $this->messageService->getMessageByIdAndUser($messageDetail->id, Auth::user()->id);
            if ($messageUpdate != null)
                $this->messageService->updateMessage($messageUpdate->id, array('read' => 1, 'subject' => $messageUpdate->subject, 'content' => $messageUpdate->content));
        }
        if ($messageDetail != null && $messageDetail->read_reply == 0) {
            $messageUpdate = $this->messageService->getMessageByFromAndReply(Auth::user()->id, $messageDetail->id);
            if ($messageUpdate != null) {
               foreach($messageUpdate as $mu)
               {
                   $mu->read_reply=1;
                   $mu->save();
               }
            }
        }
        return view('frontend.message.message_detail', compact('messageDetail', 'replyMessages'));

    }

    public function replyMessage()
    {

        if (Input::has('reply_for_id')) {
            $id = base64_decode(Input::get('reply_for_id'));
        }
        $message = $this->messageService->getMessageById($id);
        if ($message != null) {
            $ex = 'from_id';
            $me = 'to_id';
        } else {
            $ex = 'to_id';
            $me = 'from_id';
        }
        $messageDetail = $this->messageService->getDetailMessage($ex, $id, Auth::user()->id);
        if ($messageDetail != null) {
            if ($messageDetail->$ex == Auth::user()->id) {
                $his_id = $message->$me;
                $read_flag = '0';
            } else {
                $his_id = $message > $ex;
                $read_flag = '1';
            }
            if (Input::has('message')) {
                $this->messageService->insertMessage(array('from_id' => $his_id, 'to_id' => Auth::user()->id, 'subject' => Input::get('replay_subject'), 'content' => Input::get('message'), 'read' => $read_flag, 'reply_to' => $messageDetail->id
                ));
            }
        }
        return Redirect::route('message.messagedetail', array(Input::get('reply_for_id')));
    }

    public  function  getCountNewMessage()
    {
     $num=$this->messageService->getCountNewMessage(Auth::user()->id);
     return $num>0?$num:"";
    }




}