<?php namespace Penst\Services\Message;

use Penst\Models\Message\EmailAccount;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/14/15
 * Time: 8:30 PM
 */
Interface  EmailSenderInterface
{
    public function sendEmail(EmailAccount $emailAccount, $subject, $body,
                              $fromAddress, $fromName, $toAddress, $toName,
                              $replyToAddress = null, $replyToName = null,
                              array $bcc = null, array $cc = null,
                              $attachmentFilePath = null, $attachmentFileName = null,
                              $attachedDownloadId = 0);

}