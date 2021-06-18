
<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <lable for="fileToUpload">Select image to upload in root directory:</lable>
    <input type="file" name="fileToUpload[]" id="fileToUpload" multiple>
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
<br>
<a href='Render.php'>Watch images</a>
<h1>Create new folder on site</h1>

<form action="FolderCreator.php" method="post">
    Name of new folder:<input type="text" name="folder">
    <br>
    <input type="submit">
</form>

<!--<h1>Uplode file to custome folder</h1>-->
<!--<form action="upload.php" method="post">-->
<!--    Name of the custom directory:<input type="text" name="folder">-->
<!--    <br>-->
<!--    <input type="submit">-->
<!--</form>-->


<h1>Uplode file to custome folder</h1>
<form action="CustomForm.php" method="post">
    <p><select name="Form">
            <option disabled>Choose the folder</option>
            <?php session_start();
            foreach($_SESSION['varname'] as $elem){
                $rightElem = explode("/",$elem);
                echo "<option value='$elem'>$rightElem[1]</option>";
            }

            ?>
        </select></p>
    <input type="submit">
</form>
