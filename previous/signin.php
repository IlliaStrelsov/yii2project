<h1>Sign in</h1>
<form action="info.php" method="post">
    Login:<input type="text" name="login">
    <br>
    Password:<input type="text" name="password">
    <br>
    <input type="submit">
    <a href="signup.php">Sign up</a>

</form>



<?php
include "test.php";
$b = new DB();
if($_POST["login"] == ""){
    echo "<br>";
}
else {
    $l = $b->select_data("localhost", "username", "password", "Test", $_POST["login"], $_POST["password"]);
    echo $l;
}
?>