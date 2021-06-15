<?php


namespace backend\models;


use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function find(){
        return new UserQuery(get_called_class());
    }
}

class UserQuery extends ActiveQuery{

    function filterByActive()
    {
        $this->andWhere(['key' => 1]);
        return $this;
    }
}

$user =  User::find()->filterByActive()->all();