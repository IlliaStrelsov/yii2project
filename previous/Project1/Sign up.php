<form action="" method="post">
    <lable for="login">Login:</lable>
    <input type="text" name="login" id="login">
    <br>
    <lable for="password">Password:</lable>
    <input type="text" name="password" id="password">
    <br>
    <input type="submit" value="Sigh up" name="submit">
    <a href="Log%20in.php">Log in</a>
</form>


<?php
$servername = "localhost";
$username = "project";
$password = "31012002";
$dbname = "projectnew";

class SignUp
{
    public $log;
    public $pass;

    public function connect($servername, $username, $password, $dbname)
    {
        $connection = new mysqli($servername, $username, $password, $dbname);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        } else {
            echo "GOOD";
            return $connection;
        }

    }

    public function insert($connection)
    {
        $this->log = $_POST["login"];
        $this->pass = $_POST["password"];
        if($this->log == '' or $this->pass == ''){
            return "Non valid input";
        }

        $sql = "SELECT login FROM users WHERE password='$this->pass'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);

        if($row == NULL) {
            $sql = "INSERT INTO users (login,password,roots,counter) VALUES ('$this->log','$this->pass','user','0')";

            if ($connection->query($sql) === TRUE) {
                echo "<br>";
                echo "New recode successfully created";
            } else {
                echo "Error";

            }
            $connection->close();
        }else{
            echo "Sorry such record already exist";
        }
   }
}

if(isset($_POST["submit"])) {
    $conn = new SignUp();
    $connection = $conn->connect("localhost", "project", "31012002", "projectnew");
    $conn->insert($connection);
}