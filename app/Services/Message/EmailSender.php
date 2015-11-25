<?php namespace Penst\Services\Message;
use Illuminate\Support\Facades\Mail;
use Penst\Models\Message\EmailAccount;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/14/15
 * Time: 8:30 PM
 */
class EmailSender implements EmailSenderInterface
{

    public function sendEmail(EmailAccount $emailAccount, $subject, $body,
                              $fromAddress, $fromName, $toAddress, $toName,
                              $replyToAddress = null, $replyToName = null,
                              array $bcc = null, array $cc = null,
                              $attachmentFilePath = null, $attachmentFileName = null,
                              $attachedDownloadId = 0)
    {
        // Create the Transport
        $transport = \Swift_SmtpTransport::newInstance($emailAccount->host, $emailAccount->port,"ssl")
            ->setUsername($emailAccount->email)
            ->setPassword($emailAccount->password);
        $mailer = \Swift_Mailer::newInstance($transport);
        $message = \Swift_Message::newInstance($subject)
            ->setFrom(array($fromAddress => $fromName))
            ->setTo(array($toAddress =>$toName))
            ->setBody($body)
        ;
        $result = $mailer->send($message);
        return $result;


    }
}