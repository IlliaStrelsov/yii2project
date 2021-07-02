<form action="" method="post">
    <h1> Please enter your information to create a new login account </h1>
    <lable for="login">Login:</lable>
    <input type="text" name="login" id="login">
    <lable for="password">Password:</lable>
    <input type="password" name="password" id="password">
    <br>
    <br>
    <input type="submit" name="submit" id="submit" value="submit">
    <input type="reset"  id="reset" value="reset">
    <a href="signin.php">Sign in</a>
</form >

<?php



class Create{

    public function signUp(){
        if ($_POST['login'] != '' && $_POST['password'] != '') {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $text = $login . "," . $password . "\n";
            $fp = fopen('accounts.txt', 'a+');

            if (fwrite($fp, $text)) {
                return '<br><h3>Saved</h3>';
            }
            fclose($fp);
        }else{
            return "<br><h3>Login and password field can`t be blank</h3>";
        }
    }
}
if(isset($_POST['submit'])) {
    $b = new Create();
    echo $b->signUp();
}
?>
