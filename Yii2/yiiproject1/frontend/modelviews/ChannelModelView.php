<?php


namespace frontend\modelviews;


use Yii;
use yii\helpers\Url;

class ChannelModelView
{

    public $channel;


    public function __construct($channel){

        $this->channel = $channel;
    }

    public function isSubscribedUser(){

        return $this->channel->isSubscribed(Yii::$app->user->id);
    }

    public function countSubscribers(){

        return $this->channel->getSubscribers()->count();
    }

    public function urlTo()
    {
        return Url::to(['channel/subscribe','username'=>$this->channel->username]);
    }
}