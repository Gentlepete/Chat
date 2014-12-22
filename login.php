<?php
session_start();
require_once 'db_connection.php';
$con = new Db();

$name = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

if(!($user = $con->authenticate($name, $password))){
    $_SESSION['error'] = "<p style='color:red'>Name oder Password falsch!</p>";
    header("Location: index.php");
}else{
    $_SESSION['current_user_id'] = $user[0]['id'];
    $_SESSION['message'] = "Willkommen in unserem Chat, $name";
    header("Location: home.php");
}

$con->close();
