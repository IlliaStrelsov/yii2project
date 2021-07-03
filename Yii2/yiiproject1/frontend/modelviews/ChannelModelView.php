<?php


namespace frontend\modelviews;



use Yii;
use yii\helpers\Url;

/**
 * Class ChannelModelView
 * @package frontend\modelviews
 */
final class ChannelModelView
{

    public $channel;


    /**
     * ChannelModelView constructor.
     * @param $channel
     */
    public function __construct(object $channel)
    {

        $this->channel = $channel;
    }

    /**
     * @return mixed
     */
    public function isSubscribedUser(string $user)
    {

        return $this->channel->isSubscribed($user);
    }

    /**
     * @return mixed
     */
    public function countSubscribers()
    {

        return $this->channel->getSubscribers()->count();
    }

    /**
     * @return string
     */
    public function urlTo()
    {
        return Url::to(['channel/subscribe','username'=>$this->channel->username]);
    }
}