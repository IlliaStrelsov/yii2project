<?php
session_start();
function connection($servername, $username, $password, $dbname){

    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } else {
        return $connection;
    }
}

function SelectOne($connection,$value){

    $sql = "SELECT * FROM store  WHERE name='$value' LIMIT 1";
    $result = mysqli_query($connection,$sql);
    $row = mysqli_fetch_assoc($result);
    return $row;
}






$arr = array_count_values(array_column($_SESSION["list"], 'name'));
$_SESSION["number"] = $arr;
$controll_arr = [];
foreach ($_SESSION["list"] as $row){
    if(in_array($row,$controll_arr)){
        continue;
    }else{
        array_push($controll_arr,$row);
    }
}
$_SESSION["controll_arr"] = $controll_arr;
echo "<form action='' method='post'>";
foreach ($controll_arr as $row) {
    foreach ($arr as $key => $num) {
        if ($row != NULL and $key == $row["name"]) {
            if ($num > $row["number"]) {
                echo "Sorry, we dont have " . $num . " of " . $row["name"] . ".Only " . $row["number"] . " left.<br>";
            } else {
                $name = $row["name"];
                echo "Name:" . $row["name"] . "  Price:" . $row["price"] . " Number in basket: " . $num . " <input type='submit' value='Plus one ' name='$name'><br>";
            }
        }
    }
}
echo "</form>";
$sum = 0;

foreach ($_SESSION["list"] as $row) {
    $sum = $sum + $row["price"];
}

foreach ($_POST as $item=>$value){
    $goods = $item;
}

$connection = connection("localhost", "project", "31012002", "projectnew");

$res = SelectOne($connection,$goods);

array_push($_SESSION["list"],$res);
echo "<br>";
echo $goods;
echo "<br>";



echo "<br>";

echo "<br>";
echo "Total price: " . $sum;
echo "<form action='Buying.php' method='post'>";
echo "<input type='submit' value='Buy' name='submit'>";
echo "</form>";
echo "<br>";
echo "<a href='Store.php'>Store</a><br>";