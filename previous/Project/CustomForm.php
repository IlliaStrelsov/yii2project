<form action="upload.php" method="post" enctype="multipart/form-data">
    <lable for="fileToUpload">Select image to upload in chosen directory directory:</lable>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="custom" name="submit">
</form>




<?php
echo "<br>";
session_start();
$_SESSION["value"]=$_POST["Form"];
print_r($_POST);
