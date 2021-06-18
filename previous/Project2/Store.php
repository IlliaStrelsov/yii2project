<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
class Store{

    public function connection($servername, $username, $password, $dbname){

        $connection = new mysqli($servername, $username, $password, $dbname);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        } else {
            return $connection;
        }
    }

    public function selectData($connection){

        $sql = "SELECT * FROM store";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<form action='' method='post'>";
            while($row = mysqli_fetch_assoc($result)) {
                $name = $row["name"];
                echo "id: " . $row["id"]. " - Name: " . $row["name"]. " Number:" . $row["number"]. " Price:" . $row["price"] . "   <input type='submit' value='Add to Basket' name='$name'><br>";
            }

            echo "</form>";
        } else {
            echo "0 results";
        }
    }

    public function SelectOne($connection,$value){

        $sql = "SELECT * FROM store  WHERE name='$value' LIMIT 1";
        $result = mysqli_query($connection,$sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

}


echo "<a href='Form.php'>Form</a><br>";
echo "<a href='Basket.php'>Basket</a><br>";
session_start();
$conn = new Store();
$connection = $conn->connection("localhost", "project", "31012002", "projectnew");
$conn->selectData($connection);

foreach ($_POST as $item=>$value){
    $goods = $item;
}
echo $goods;

$row = $conn->SelectOne($connection,$goods);
echo "<br>";
print_r($row);

echo "<br>";
$_SESSION["list"][] = $row;
echo "<br>";
print_r($_SESSION);


