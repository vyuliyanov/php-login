<?php

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
    <input type="password" name="re_password" placeholder="Re-Password"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="submit" name="register" value="Register"><br>
</form>

<?php 

    if(!empty($_POST['nickname']) && !empty($_POST['password']) && !empty($_POST['re_password']) && !empty($_POST['email'])){
        $nickname = $_POST['nickname'];
        $password = $_POST['password'];
        $re_password = $_POST['re_password'];
        $email = $_POST['email'];

        if($password != $re_password){
            echo 'Password does not match';
            return;
        }
      
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Email is not valid';
            return;   
        }

        $userExists = $db->selectOne("SELECT id FROM users WHERE nickname = '$nickname' OR email = '$email'");
        if(!empty($userExists)){
            echo 'User already exists';
            return;
        }
        
        $md5_password = md5($password);        
        $insertData = array(
            'nickname' => $nickname,
            'password' => $md5_password,
            'email' => $email,
        );
        echo 'Successful!';
        $db->insert('users', $insertData);

    }
?>