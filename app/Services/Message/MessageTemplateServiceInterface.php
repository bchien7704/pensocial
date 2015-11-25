<?php namespace Penst\Services\Message;
/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/11/15
 * Time: 6:04 PM
 */


Interface  MessageTemplateServiceInterface
{
    public  function  deleteMessageTemplate($id);

    public  function  updateMessageTemplate($id,$attributes);

    public  function  insertMessageTemplate($attributes);

    public function  getMessageTemplateById($messageTemplateId);

    public function  getMessageTemplateByName($messageTemplateName);

    public  function  getAllMessageTemplate();


}