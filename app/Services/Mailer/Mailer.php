<?php namespace Penst\Services;

use Mail;
use Penst\Services\MailerInterface;

/**
 * Class Mailer
 * @package Fully\Services
 * @author Sefa Karagöz
 */
class Mailer implements MailerInterface {

    public function send($view, $email, $subject, $data = array()) {

        Mail::send($view, $data, function ($message) use ($email, $subject) {

            $message->from('noreply@fullycms.com');
            $message->to($email)->subject($subject);
        });
    }

    public function queue($view, $email, $subject, $data = array()) {

        Mail::queue($view, $data, function ($message) use ($email, $subject) {

            $message->from('noreply@fullycms.com');
            $message->to($email)->subject($subject);
        });
    }
}
