<?php
require_once 'db_connection.php';
$con = new connection();
$con->connect();

$name = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$password = md5(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));
echo $password;

try
{
    $sql = "INSERT INTO `user` (`name`, `password`) VALUES ('$name', '$password')";
    if ($con->query($sql))
    {
        echo "erfolg";
    }
    else
    {
        throw new Exception("Der User mit dem Namen $name ist bereits vorhanden");
    }
   
} catch (Exception $e) {
    echo $e->getMessage();
    //header("Location: sign_up.html");
}


