<?php

session_start();
require_once 'db_connection.php';
$con = new connection();
$con->connect();

$post = filter_input(INPUT_POST, "post", FILTER_SANITIZE_STRING);
$user_id = $_SESSION['current_user_id'];

$sql = "INSERT post (message, user_id) VALUES ('$post', '$user_id')";
$con->query($sql);


$con->close();

header("Location: home.php");

