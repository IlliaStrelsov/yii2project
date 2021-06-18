<?php
class Render
{
    public function __construct($link,$target_dir = "uploads/")
    {
        $target_dir = "uploads/$link/";
        $this->images = scandir($target_dir);
    }
    public $pointSkipper = array(".", "..");
    //print all images in directory uploads and take an img that we want to del
    public function renderImages(){
        foreach ($this->images as $image)
        {
            if (!in_array($image, $this->pointSkipper)){
                if(is_dir("uploads/$image/")){
                    continue;
//                    echo "<form action='Render.php' method='post'>";
//                    echo "<input type='checkbox' name='image' value='$image' />";
//                    echo "<input type='submit' name='formSubmit' value='Submit' />";
//                    echo "</form>";
//                    echo "<br><br>";
                }
                echo "<br>";
                echo $image;
                echo "<br>";
                if(strstr($image, "mp4")){
                    echo "<video width='320' height='240' controls>";
                    echo "<source src='uploads/$image' type='video/mp4'>";
                    echo "<source src='uploads/$image' type='video/ogg'> Your browser does not support the video tag.";
                    echo "</video> ";
                }
                else {
                    echo "<img src='uploads/$image'>";
                }
                echo "<form action='Render.php' method='post'>";
                echo "<input type='checkbox' name='image' value='$image' />";
                echo "<input type='submit' name='formSubmit' value='Delete' />";
                echo "</form>";
                echo "<br><br>";

            }
        }
    }
    // delete an img
    public function deleteImg(){
        if (isset($_POST["image"])) {
            $img = $_POST["image"];
            unlink("uploads/$img");
            header("Location: Render.php");
        }
    }
}

echo "<br>";
echo "<a href='Form.php'>Add new image</a>";
echo "<br>";
$renderer = new Render("");
$renderer->renderImages();
$renderer->deleteImg();
?>