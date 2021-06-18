<form action="" method="post">
    <label for="image">Submit to confirm that you are not a bot</label>
    <br>
    <input type='checkbox' name='image' value='checkbox'>
    <input type="submit" value="Confirm" name="submit">
    <a href="Log%20in.php">Log in</a>
</form>



<?php
session_start();
$_SESSION["kaptcha_create"] = time();
$time = $_SESSION["kaptcha_create"];
echo $_SESSION["kaptcha_create"];
$connection = new mysqli("localhost","project","31012002","projectnew");
if($connection->connect_error){
    die("Connection failed: " . $connection->connect_error);
}else{
    echo "Good";
}

$sql = "INSERT INTO kaptcha (entertime) VALUES ('$time')";
if ($connection->query($sql) === TRUE){
    echo "<br>Get time";
}else{
    echo "<br>Error";
}

if(isset($_POST["submit"])) {
    $_SESSION["kaptcha_submit"] = time();
    $times = $_SESSION["kaptcha_submit"];
    echo $_SESSION["kaptcha_submit"];
    $sql = "UPDATE kaptcha SET confirmtime='$times' WHERE entertime='$time'";
    if ($connection->query($sql) === TRUE) {
        echo "<br>Get time";
    } else {
        echo "<br>Error";
    }


    $sql = "SELECT * FROM kaptcha ORDER BY id DESC LIMIT 2";
    $result = $connection->query($sql);
    $timearr = [];
    while ($row = $result->fetch_assoc()) {
        echo "<br> " . $row["entertime"];
        array_push($timearr, $row["entertime"]);
    }
    echo "<br>";
    print_r($timearr);
    if ($timearr[0] - $timearr[1] < 1) {
        echo "<br>error";
        array_push($_SESSION["array"],$_SERVER['REMOTE_ADDR']);
    } else {
        echo "<br>OK";
        ob_start();
        header('Location: Log in.php');
        ob_end_flush();
        die();

    }
}


