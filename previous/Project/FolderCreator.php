<?php


namespace app\Project;


class FolderCreator
{

    public function createNewFolder()
    {
        $fileName = $_POST["folder"];
        if(mkdir("uploads/$fileName",0777)){
            return "New folder was created with name $fileName";
        }
        else{
            return "Cant create folder";
        }
    }


}
$a = new FolderCreator();
echo $a->createNewFolder();
echo "<br>";
echo "<a href='Form.php'>Add new image</a>";
echo "<br>";