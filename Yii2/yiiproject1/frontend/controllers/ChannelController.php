<?php


namespace frontend\controllers;


use common\models\Subscriber;
use common\models\User;
use frontend\modelviews\ChannelModelView;
use frontend\repositories\UserRepository;
use frontend\services\ChannelService;
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
        $userRepository = new UserRepository();
        $channel = $userRepository->findChannel($username);
        if(!$channel){
            throw new NotFoundHttpException();
        }

        $viewModel = new ChannelModelView($channel);
        return $this->render('view',[
            'viewModel'=> $viewModel
        ]);
    }


    public function actionSubscribe($username){

        $userRepository = new UserRepository();
        $channel = $userRepository->findChannel($username);
        if(!$channel){
            throw new NotFoundHttpException();
        }


        $userId = \Yii::$app->user->id;
        $subscriber = $channel->isSubscribed($userId);


        if(!$subscriber) {
            $subscribe = new ChannelService();
            $subscribe->subscribe($username,$subscribe,$channel, $userId);

            \Yii::$app->mailer->compose([
                'html' => 'subscriber-html', 'text'=> 'subscriber-text'
            ],[
                'channel' => $channel,
                'user' => \Yii::$app->user->identity
            ])->setFrom(\Yii::$app->params['senderEmail'])
            ->setTo($channel->email)->setSubject('You have new subscriber')->send();
        }else {
            $subscriber->delete();
        }

        $viewModel = new ChannelModelView($channel);
        return $this->renderAjax('_subscribe',[
            'viewModel' => $viewModel
        ]);
    }

}