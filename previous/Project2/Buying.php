<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();

function connection($servername, $username, $password, $dbname){

    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } else {
        return $connection;
    }
}
function changeNumber($connection,$value,$newvalue){
    $sql = "SELECT number FROM store WHERE name='$value' LIMIT 1";
    $result = mysqli_query($connection,$sql);
    $row = mysqli_fetch_assoc($result);
    $row["number"] = $row["number"] - $newvalue;
    $num = $row["number"];
    $sql = "UPDATE store SET number='$num' WHERE name='$value'";

    if ($connection->query($sql) === TRUE) {
        return "Record updated successfully<br>";
    } else {
        return "Error updating record: " . $connection->error;
    }
}

$connection = connection("localhost", "project", "31012002", "projectnew");
print_r($_SESSION["number"]);
foreach ($_SESSION["number"] as $key=>$value){
    echo changeNumber($connection,$key,$value);
}