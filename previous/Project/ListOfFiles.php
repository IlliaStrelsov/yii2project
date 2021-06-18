<?php


namespace app\Project;


class ListOfFiles
{
    public const listOfDirectories = [];

    public function getLst(){
        $directories = glob("uploads/" . '*' , GLOB_ONLYDIR);
        return $directories;
    }
}


$lst = new ListOfFiles();
$list = $lst->getLst();
session_start();
$_SESSION['varname'] = $list;
print_r($_SESSION['varname']);
//define('listOfDirectories',$list);
//print_r(listOfDirectories);
