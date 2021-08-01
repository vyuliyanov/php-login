<?php
session_start();
define("DB_HOST", "localhost");
define("DB_NAME", "tut_db");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");

include('Database.php');

$db = new Database();

?>

<form method="POST">
    <input type="text" name="nickname" placeholder="Nickname"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <input type="submit" name="login" value="Login"><br>
</form>

<?php 
    if(!empty($_POST['nickname']) && !empty($_POST['password'])){

        $nickname = $_POST['nickname'];
        $password = $_POST['password'];

        $md5_password = md5($password);
        
        $userExists = $db->selectOne("SELECT id FROM users WHERE nickname = '$nickname' AND `password` = '$md5_password'");
        if(empty($userExists)){
            echo 'User does not exists';
            return;
        }

        $_SESSION['user_id'] = $userExists['id'];
        echo '<a href="profile.php">Profile</a>';

    }

?>