<a href="Log%20in.php">Log in</a>
<a href="Sign%20up.php">Sign up</a>

<?php
session_start();
echo $_SESSION["roots"];
if($_SESSION["roots"] == "admin"){
    echo "<br><a href='landing.php'>landing</a>";
    echo "<br><a href='footer.php.php'>footer</a>";

}elseif ($_SESSION["roots"] == "user"){
    echo "<br><a href='landing.php'>landing</a>";
}