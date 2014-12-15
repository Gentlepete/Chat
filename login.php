<?php
session_start();
require_once 'db_connection.php';
$con = new connection();
$con->connect();

$name = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

$sql = "SELECT * FROM user WHERE name = '$name' AND password = '$password'";
$res = $con->query($sql);

if(!$res)
{
    $_SESSION['error'] = "<p style='color:red'>Username oder Password falsch!</p>";
    header("Location: index.php");
}
else
{
    $user = $con->get_query_data($res);
    $_SESSION['current_user_id'] = $user['id'];
    header("Location: home.php");
}

