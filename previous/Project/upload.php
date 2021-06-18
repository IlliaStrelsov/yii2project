<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include "class.upload.php";
print_r($_POST);
class Uploader
{

    public $status = 1;//is status 1 => img ca be uploaded elif its 0 so file cannot be uploaded

// In this part we check if file is an image or not
    public function validateImage($link)

    {
        foreach ($_FILES["fileToUpload"]["name"] as $key => $file) {
            $link = explode("/", $link);
            $link = $link[1];
            $target_dir = "uploads/$link/";
            $this->target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$key]);
            $this->imageFileType = explode(".", $this->target_file);
            if (isset($_POST["submit"])) {
                //check if file is img by using getimagesize
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$key]);
                if ($check !== false or strstr($_FILES["fileToUpload"]["type"][$key], "mp4")) {
                    $this->status = 1;

                } else {
                    $this->status = 0;
                    echo "File is not an image.";

                }
            }

//All validations for uploaded file


// Check if file already exists
            if (file_exists($this->target_file) and !is_dir($this->target_file)) {
                $this->status = 0;
                echo "Sorry, file already exists.";

            }

// Check file size
            if ($_FILES["fileToUpload"]["size"][$key] > 1000000000000000) {
                $this->status = 0;
                echo "Sorry, your file is too large.";

            }

// Allow certain file formats
            if ($this->imageFileType[1] != "png" && $this->imageFileType[1] != "jpeg" && $this->imageFileType[1] != "jpg" && $this->imageFileType[1] != "gif" && $this->imageFileType[1] != "mp4") {
                $this->status = 0;
                echo "Sorry, only PNG,JPEG,JPG and GIF files are allowed.";

            }

        }
    }

    public function addImage($link)
    {

        foreach ($_FILES["fileToUpload"]["name"] as $key => $file) {
            $link = explode("/", $link);
            $link = $link[1];
            $target_dir = "uploads/$link/";
            $this->target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$key]);
            $this->imageFileType = explode(".", $this->target_file);

// Check if status is 0 or 1
            if ($this->status == 0) {
                echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $this->target_file)) {
                    echo "<br>";
                    echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"][$key])) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }


    public function differentSizeUploader($file,$key,$h,$w){
        $filename = "uploads/".$file["fileToUpload"]["name"][$key];
        list($wight,$height) = getimagesize($filename);
        $newwidth = $wight + $w;
        $newheight = $height + $h;
        $thumb = imagecreatetruecolor($newwidth,$newheight);
        $source = imagecreatefromjpeg($filename);
        imagecopyresized($thumb,$source,0,0,0,0,$newwidth,$newheight,$wight,$height);
        echo "<br>";
        return $thumb;
    }





}
if ($_POST["submit"] == "Upload Image") {
    $link = "";
    echo "<pre>";
    print_r ($_FILES["fileToUpload"]);
    echo "</pre>";

} elseif ($_POST["submit"] == "custom") {
    session_start();
    $link = $_SESSION["value"];
}
$curimg = new Uploader();
echo $curimg->validateImage($link);
echo "<br>";
echo $curimg->addImage($link);
imagejpeg($curimg->differentSizeUploader($_FILES,0,200,300),"result.jpeg");
if(!rename("result.jpeg","uploads/smth.png"))
echo "<br>";

//$foo = new \Verot\Upload\Upload("/uploads/website.jpg");
//if($foo->uploaded){
//    $foo->image_resize = true;
//    $foo->image_x = 600;
//    $foo->image_ratio_y = true;
//    $foo->process('/uploads/');
//    if ($foo->processed) {
//        echo 'image renamed, resized x=100
//           and converted to GIF';
//        $foo->clean();
//    } else {
//        echo 'error : ' . $foo->error;
//    }
//}else{
//    echo "Error<br>";
//    echo $foo->log;
//}


echo "<a href='Render.php'>Watch images</a>"
?>








