<?php

class Database
{
    //Database parameters
    private $localhost = 'localhost';
    private $username = 'project';
    private $password = '31012002';
    private $dbname = 'projectnew';
    private $conn;

    //Connection to DB
    public function connect(){
        $this->conn = null;

        try{
            $this->conn = new \PDO('mysql:host=' . $this->localhost . ';dbname=' . $this->dbname,$this->username,$this->password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
        }catch (\PDOException $e){
            echo "Connetion Error: " . $e->getMessage();
        }

        return $this->conn;
    }
}