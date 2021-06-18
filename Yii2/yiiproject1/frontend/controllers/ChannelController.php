<?php


namespace frontend\controllers;


use common\models\Subscriber;
use common\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ChannelController extends Controller
{

    public function behaviors()
    {
        return [
            'access'=> [
                'class' => AccessControl::class,
                'only' => ['subscribe'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
        ];
    }


    public function actionView($username){
        $channel = $this->findChannel($username);

        return $this->render('view',[
            'channel'=> $channel
        ]);
    }


    public function actionSubscribe($username){

        $channel = $this->findChannel($username);

        $userId = \Yii::$app->user->id;
        $subscriber = $channel->isSubscribed($userId);


        if(!$subscriber) {
            $subscriber = new Subscriber();
            $subscriber->channel_id = $channel->id;
            $subscriber->user_id = $userId;
            $subscriber->created_at = time();
            $subscriber->save();
        }else {
            $subscriber->delete();
        }

        return $this->renderAjax('_subscribe',[
            'channel' => $channel
        ]);
    }

    public function findChannel($username){
        $channel = User::findByUsername($username);
        if(!$channel){
            throw new NotFoundHttpException("No such channel");
        }

        return $channel;
    }
}