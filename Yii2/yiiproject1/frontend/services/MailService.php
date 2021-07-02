<?php


namespace frontend\services;


use Yii;

class MailService
{

    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;


    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}