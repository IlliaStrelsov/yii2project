<form action="" method="post">
    <lable for="name">Name of ware:</lable>
    <input type="text" name="name" id="name">
    <br>
    <lable for="price">Price:</lable>
    <input type="text" name="price" id="price">
    <br>
    <lable for="number">Number:</lable>
    <input type="text" name="number" id="number">
    <br>
    <input type="submit" value="Insert" name="submit">
    <a href="Store.php">Bag</a>
</form>
<br>
<form action="" method="post">
    <lable for="name">Name of ware:</lable>
    <input type="text" name="name_select" id="name_select">
    <br>
    <input type="submit" value="Select" name="submit">
</form>


<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
//class Database{
//
//    public $name;
//    public $price;
//    public $number;
//
//    public function connection($servername, $username, $password, $dbname){
//
//        $connection = new mysqli($servername, $username, $password, $dbname);
//        if ($connection->connect_error) {
//            die("Connection failed: " . $connection->connect_error);
//        } else {
//            return $connection;
//        }
//    }
//
//    public function insertWare($connection){
//        $this->name = $_POST["name"];
//        $this->price = $_POST["price"];
//        $this->number = $_POST["number"];
//        $sql = "INSERT INTO store (name,number,price) VALUES ('$this->name','$this->number','$this->price')";
//
//        if (mysqli_query($connection, $sql)) {
//            return json_encode(array("message" => "Product was created"));
//        } else {
//            return json_encode(array("message" => "Error: " . $sql . "<br>" . mysqli_error($connection)));
//        }
//    }
//
//    public function selectWare($connection,$name){
//
//        $sql = "SELECT * FROM store WHERE name='$name'";
//        $result = $connection->query($sql);
//
//        if ($result->num_rows > 0) {
//            $row = $result->fetch_assoc();
//            http_response_code(200);
//            return json_encode($row);
//        }else{
//            http_response_code(404);
//            return json_encode(array("message" => "No product found"));
//        }
//    }
//}
//
//if(isset($_POST["submit"]) && $_POST["submit"] === "Select" ){
//    $conn = new Database();
//    $connection = $conn->connection("localhost", "project", "31012002", "projectnew");
//    $data_json = $conn->selectWare($connection,$_POST["name_select"]);
//    echo $data_json;
//    $data_array = json_decode($data_json);
//    $data = http_build_query($data_array);
//    $ch = curl_init();
//    curl_setopt($ch,CURLOPT_URL , 'http://www.example1.com/Project2/Form.php');
//    curl_setopt($ch, CURLOPT_POST, 1);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//    curl_setopt($ch, CURLOPT_FAILONERROR,true);
//
//    $result = curl_exec($ch);
//    $error = curl_error($ch);
//
//    if (!empty($error)){
//        echo $error;
//        return;
//    }
//    curl_close($ch);
//    parse_str($result,$output);
//    echo $output['description'];
//}
//
//if(isset($_POST["submit"]) && $_POST["submit"] === "Insert" ){
//    $conn = new Database();
//    $connection = $conn->connection("localhost", "project", "31012002", "projectnew");
//    echo $conn->insertWare($connection);
//}

