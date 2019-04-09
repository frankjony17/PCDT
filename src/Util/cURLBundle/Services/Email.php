<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 01/04/2015
 * Time: 11:13
 */

namespace Util\cURLBundle\Services;


class Email
{
    private $mailer, $subject, $from;

    function __construct($mailer)
    {
        $this->mailer = $mailer;
    }

    public function subject($subject)
    {
        $this->subject = $subject;
    }

    public function from($from)
    {
        $this->from = $from;
    }

    public function send($to, $body)
    {
        $message = \Swift_Message::newInstance()->setSubject($this->subject)->setFrom($this->from)->setTo($to)->setBody($body,'text/html');

        return $this->mailer->send($message);
    }
}