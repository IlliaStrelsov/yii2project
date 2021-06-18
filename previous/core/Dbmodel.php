<?php


namespace app\core;


abstract class Dbmodel extends Model
{
    abstract public function tableName():string;

    public function save()
    {
        $tableName = $this->tableName();
        $attribute = $this->attribute();
    }
}