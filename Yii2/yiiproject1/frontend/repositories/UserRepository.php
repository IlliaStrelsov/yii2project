<?php


namespace frontend\repositories;


use common\models\User;
use yii\web\NotFoundHttpException;

class UserRepository
{

    /**
     * @param $username
     * @return User
     * @throws NotFoundHttpException
     */
    public function findChannel($username){
        return User::findByUsername($username);
    }


}