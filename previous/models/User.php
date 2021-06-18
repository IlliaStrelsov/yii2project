<?php


namespace app\models;


use app\core\Dbmodel;
use app\core\Model;

class User extends Dbmodel
{
    public  string $firstname = '';
    public  string $lastname = '';
    public  string $email = '';
    public  string $password = '';
    public  string $confirmPassword = '';

    public function tableName(): string
    {
        return 'user';
    }
    public function register()
    {
        echo "Creating new user";
    }

    public function rules():array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED,[self::RULE_MIN, 'min'=>8],[self::RULE_MAX,'max'=>24]],
            'confirmPassword' => [self::RULE_REQUIRED,[self::RULE_MATCH,'match'=>'password']],
        ];
    }
}