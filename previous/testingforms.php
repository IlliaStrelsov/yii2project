
<h1>Sign up</h1>
<form action="testingforms.php" method="post">
    Login:<input type="text" name="logininput">
    <br>
Password:<input type="text" name="passwordinput">
    <br>
    <input type="submit">
    <a href="signin.php">Come back</a>

</form>

<?php
echo $_POST["logininput"];
echo '<br>';
echo $_POST["passwordinput"];

