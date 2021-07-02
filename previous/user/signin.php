
<form action="" method="post">
    <h1> Please enter your information to log into</h1>
    <lable for="login">Login:</lable>
    <input type="text" name="login" id="login">
    <lable for="password">Password:</lable>
    <input type="password" name="password" id="password">
    <br><br>
    <input type="submit" value="submit" name="submit">
    <input type="reset"  id="reset" value="reset">
    <a href="create.php">Sign up</a>
</form>


<?php


class SignIn{

    public function authorise(){
        if(isset($_POST['submit'])) {
            $file = file("accounts.txt");

            $all_ids = explode("\n", file_get_contents("accounts.txt"));
            $check_value  = $_POST['login'] .",".  $_POST['password'];

            if (in_array($check_value, $all_ids)){
                session_start();
                $_SESSION['status'] = 1;
                header("Location: ../BTNcurency.php");
            }else{
                session_start();
                $_SESSION['status'] = 0;
                return "<br><br><h3>Wrong login or password</h3>";
            }

        }
    }

}

if(isset($_POST['submit'])) {
    $c = new SignIn();
    echo $c->authorise();
}
?>