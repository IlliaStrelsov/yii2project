<?php

namespace frontend\services;

use common\models\Subscriber;

class ChannelService
{


    public function subscribe($username, $subscriber, $channel, $userId)
    {

        $subscriber = new Subscriber();
        $subscriber->channel_id = $channel->id;
        $subscriber->user_id = $userId;
        $subscriber->created_at = time();
        $subscriber->save();

    }



}