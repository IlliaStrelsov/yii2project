<!DOCTYPE html>
<html>
<body>


<?php

include 'test.php';
class ToDoList
{
    function __construct($db){
        $this->db = $db;

    }
    function echoLst()
    {
        $this->lst = $this->db->select_data_lst("localhost", "username", "password", "Test", $_POST["login"], $_POST["password"]);
        unserialize($this->lst);
        echo "<h3>Your to do list</h3>";
        foreach ($this->lst as $key=>$item) {
            echo $key + 1;
            echo ".";
            echo $item;
            echo "<br>";
        }
    }
    
    function addElement($new)
    {

        array_push($this->lst, $new);
        serialize($this->lst);
        $this->db->update_db("localhost", "username", "password", "Test", $_POST["login"], $_POST["password"],$this->lst);

    }

    function removeElement($index)
    {
        $this->lst[$index] = "<strike>$this->lst[$index]</strike>";
        array_push($this->lst,$this->lst[$index]);

        #unset($this->lst[$index]);
    }
}


echo "<br>";
$b = new DB();
$a = new ToDoList($b);
if ($_POST["addElement"] == "") {
    echo " ";
} else {
    $n = $_POST["addElement"];
    $a->addElement($n);
    $a->echoLst();
}
if ($_POST["delElement"] == "") {
    echo "";
} else {
    $a->removeElement($_POST["delElement"]);
    $a->echoLst();
}

?>
<form action="info.php" method="post">
    <br>
    Add:<input type="text" name="addElement">
    <br>
    <input type="submit">
    <br>
</form>
    <form action="info.php" method="post">
        <br>
        Done:<input type="text" name="delElement">
        <br>
        <input type="submit">
        <br>
    </form>
<br>
<a href="signin.php">Change account</a>
</body>
</html>
