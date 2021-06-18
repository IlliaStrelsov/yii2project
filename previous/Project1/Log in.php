<form action="" method="post">
    <lable for="login">Login:</lable>
    <input type="text" name="login" id="login">
    <br>
    <lable for="password">Password:</lable>
    <input type="text" name="password" id="password">
    <br>
    <input type="submit" value="Log in" name="submit">
    <a href="Sign%20up.php">Sign up</a>
    <br>
</form>


<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
class SignIn{
    public $log;
    public $pass;

    public function connection($servername, $username, $password, $dbname){

    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } else {
        echo "GOOD";
        return $connection;
    }
}

    public function signInto($connection)
    {
        $this->log = $_POST["login"];
        $this->pass = $_POST["password"];

        $sql = "SELECT roots FROM users WHERE login='$this->log' AND password='$this->pass';";
        $result = mysqli_query($connection, $sql);

        $row = mysqli_fetch_assoc($result);

        if ($row == NULL){
            return "Wrong login or password";
        }
        if($row["roots"] != '' and $row["roots"] != NULL) {
            $root = $row["roots"];
            $_SESSION["roots"] = $root;
            echo $_SESSION["roots"];
        }
    }
    public function update($column,$toUpdate,$connection){
        $this->log = $_POST["login"];
        $this->pass = $_POST["password"];
        $sql = "UPDATE users SET $column='$toUpdate' WHERE login='$this->log'; ";

        if($connection->query($sql) === True){
            return "Record updated";
        }else{
            return "Error updating record:" . $connection->error;
        }
    }



}

if (isset($_POST["submit"])) {
    session_start();
    if(empty($_SESSION["num_of_attempts"])) {
        $_SESSION["num_of_attempts"] = 0;
    }


    $conn = new SignIn();
    $connection = $conn->connection("localhost","project","31012002","projectnew");
    $message = $conn->signInto($connection);
    $log = $_POST["login"];
    $sql = "SELECT counter,time FROM users WHERE login='$log' ";
    $result = $connection->query($sql);
    echo "<pre>";
    var_dump($result);
    echo "</pre>";

    if($result != false) {
        $row = $result->fetch_assoc();

        foreach($_SESSION["array"] as $item){
            if($item === $_SERVER['REMOTE_ADDR']){
                $_SESSION["login"] = $log;
                ob_start();
                header('Location: WaitingRoom.php');
                ob_end_flush();
                die();
            }
        }

        if ($row["counter"] >= 3) {
            if (time() - $row["time"] < 1 * 60 * 60) {
                $_SESSION["ip_adress"] = $_SERVER['REMOTE_ADDR'];
                ob_start();
                header('Location: WaitingRoom.php');
                ob_end_flush();
                die();
//                echo $_SESSION["ip_adress"];
//                echo "<br>error";
            } else {
                $_SESSION["num_of_attempts"] = 0;
                echo $conn->update("counter", $_SESSION["num_of_attempts"], $connection);
            }
        }
    }
    if($message == "Wrong login or password"){
        echo "<br>";
        echo $message;
        echo "<br>";
        $_SESSION["num_of_attempts"] ++;
        echo $_SESSION["num_of_attempts"];
        echo "<br>";
        echo $conn->update("counter",$_SESSION["num_of_attempts"], $connection);
        echo "<br>";
        echo $_SESSION['last_login_time'] = time();
        echo "<br>";
        echo $conn->update("time",$_SESSION['last_login_time'] ,$connection);
//        ob_start();
//        header('Location: Kaptcha.php');
//        ob_end_flush();
//        die();


    } else {
        $_SESSION["num_of_attempts"] = 0;
        echo $_SESSION["num_of_attempts"];
        echo $conn->update("counter",$_SESSION["num_of_attempts"], $connection);
//        ob_start();
//        header('Location: mainPage.php');
//        ob_end_flush();
//        die();
    }
}