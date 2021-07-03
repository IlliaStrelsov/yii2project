<?php

namespace frontend\services;

use common\models\Subscriber;
use yii\db\Exception;

/**
 * Class ChannelService
 * @package frontend\services
 */
final class ChannelService
{

    /**
     * @param $username
     * @param $subscriber
     * @param $channel
     * @param $userId
     */
    public function subscribe(string $username, $subscriber,object $channel, int $userId)
    {

        $subscriber = new Subscriber();
        $subscriber->channel_id = $channel->id;
        $subscriber->user_id = $userId;
        $subscriber->created_at = time();
        if(!$subscriber->save()){
            throw new Exception("Can`t save");
        }

    }



}