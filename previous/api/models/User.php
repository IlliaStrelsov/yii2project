<?php

class User
{
    public $email;
    public $password;


    public function create()
    {
        if (!empty($this->email)  && !empty($this->password)) {
            $this->password = password_hash($this->password,PASSWORD_DEFAULT,['cost' => 12]);
            $text = $this->email . "," . $this->password . "\n";
            $fp = fopen("../database/accounts.txt", 'a+');
            if (fwrite($fp, $text)) {
                fclose($fp);
                return true;
            } else {
                return false;

            }

        }
    }

    public function uniqueEmailFound(){
        $all_ids = explode("\n", file_get_contents("../database/accounts.txt"));
        foreach ($all_ids as $item){
            $arr = explode(',',$item);
            if(in_array($this->email,$arr)){
                return false;
            }
        }
        return true;


    }

    public function signin()
    {
        $all_ids = explode("\n", file_get_contents("../database/accounts.txt"));
        foreach ($all_ids as $item) {
            $arr = explode(',', $item);
            if ($arr[0] === $this->email) {
                if (password_verify($this->password, $arr[1])) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        return false;

    }
}