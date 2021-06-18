<h1>Waiting room</h1><br>
<p>Your limit of tries ended , so you have to wait until next try:</p><br>
<a href="Log%20in.php">Log in</a>

<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
if(isset($_SESSION["array"])) {
    echo "";
}else{
    $_SESSION["array"] = [];
}
array_push($_SESSION["array"],$_SESSION["ip_adress"]);

$connection = new mysqli("localhost","project","31012002","projectnew");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} else {
    echo "<br>GOOD";
}


$log = $_SESSION["login"];
$sql = "SELECT counter,time FROM users WHERE login='$log' ";
$result = $connection->query($sql);
if($result != false) {
    $row = $result->fetch_assoc();
}

if (time() - $row["time"] < 5 * 60*60) {
    echo "<br>Good";
    $diff = time() - $row["time"];
    $diffsleep = 5*60*60 - $diff;
    echo "<br>Minutes left to wait:";
    echo $diff/60;
//    sleep($diffsleep);
}else{
    echo "<br>Bad";
    foreach($_SESSION as $key=>$item){
        if($_SESSION["array"][$key] === $_SESSION["ip_adress"]){
            unset($_SESSION["array"][$key]);
        }
    }

}


echo "<br>";
print_r($_SESSION["array"]);



