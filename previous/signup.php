<h1>Sign up</h1>
<form action="info.php" method="post">
    Login:<input type="text" name="logininput">
    <br>
    Password:<input type="text" name="passwordinput">
    <br>
    <input type="submit" value = "Send">
    <a href="signin.php">Come back</a>

</form>

<?php
include "test.php";
$b = new DB();
if($_POST["logininput"] == ""){
    echo "<br>";
}
else {
    $lst = array("Have a nice time");
    $lst = serialize($lst);
    $d = $b->insert_data_lst("localhost", "username", "password", "Test", $_POST["logininput"], $_POST["passwordinput"],$lst);
    echo $d;

}
?>

