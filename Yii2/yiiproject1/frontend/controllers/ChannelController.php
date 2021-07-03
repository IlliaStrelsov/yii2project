<?php


namespace frontend\controllers;


use common\models\Subscriber;
use common\models\User;
use frontend\modelviews\ChannelModelView;
use frontend\repositories\UserRepository;
use frontend\services\ChannelService;
use frontend\services\MailService;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class ChannelController
 * @package frontend\controllers
 */
class ChannelController extends Controller
{

    /**
     * @return array[]
     */
    public function behaviors():array
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

    /**
     * @param $username
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(string $username):string
    {
        $userRepository = new UserRepository();
        $channel = $userRepository->findChannelByUsername($username);
        if(!$channel){

            throw new NotFoundHttpException();
        }

        $viewModel = new ChannelModelView($channel);
        return $this->render('view',[
            'viewModel'=> $viewModel
        ]);
    }


    /**
     * @param $username
     * @return string
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionSubscribe(string $username):string
    {

        $userRepository = new UserRepository();
        $channel = $userRepository->findChannelByUsername($username);
        if(!$channel){

            throw new NotFoundHttpException();
        }


        $userId = \Yii::$app->user->id;
        $subscriber = $channel->isSubscribed($userId);


        if(!$subscriber) {

            $subscribe = new ChannelService();
            $subscribe->subscribe($username,$subscribe,$channel, $userId);

            $mailServer = new MailService();
            $mailServer->mailSend($channel,\Yii::$app->user->identity,\Yii::$app->params['senderEmail']);

        }else {

            $subscriber->delete();
        }

        $viewModel = new ChannelModelView($channel);
        return $this->renderAjax('_subscribe',[
            'viewModel' => $viewModel
        ]);
    }

}