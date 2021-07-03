<?php


namespace frontend\repositories;


use common\models\User;
use yii\web\NotFoundHttpException;

/**
 * Class UserRepository
 * @package frontend\repositories
 */
final class UserRepository
{

    /**
     * @param $username
     * @return User
     * @throws NotFoundHttpException
     */
    public function findChannelByUsername(string $username):object
    {
        return User::findByUsername($username);
    }


}