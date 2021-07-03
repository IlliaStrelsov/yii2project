<?php


namespace frontend\services;


use Yii;
use yii\web\IdentityInterface;

/**
 * Class MailService
 * @package frontend\services
 */
final class MailService
{

    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * @param $email
     * @return bool
     */
    public function sendEmail(string $email):bool
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }

    /**
     * @param $channel
     * @param $user
     * @param $email
     */
    public function mailSend(object $channel,IdentityInterface $user,string $email):void
    {
        \Yii::$app->mailer->compose([
            'html' => 'subscriber-html',
            'text'=> 'subscriber-text'
        ],[
            'channel' => $channel,
            'user' => $user
        ])->setFrom($email)
            ->setTo($channel->email)->setSubject('You have new subscriber')->send();
    }
}