<?php
session_start();
define("DB_HOST", "localhost");
define("DB_NAME", "tut_db");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");

include('Database.php');

$db = new Database();

if(empty($_SESSION['user_id'])){
    echo 'You are not logged - <a href="login.php">Login</a>';
    return;
}


$user = $db->selectOne("SELECT nickname, email FROM users WHERE id = '".$_SESSION['user_id']."'");

echo 'Здравей '. $user['nickname'].'<br>';
echo '<a href="logout.php">Logout</a>';
?>
