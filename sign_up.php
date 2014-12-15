<?php
session_start();
require_once 'db_connection.php';
$con = new connection();
$con->connect();

$name = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$password = md5(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));

$sql = "INSERT user (name, password) VALUES ('$name', '$password')";

try
{
    if ($con->query($sql))
    {
        echo "<p>Benutzer erfolgreich erstellt.</p>";
        echo "<a href='index.php'>zum Login</a>";
    }
    else
    {
        throw new Exception("<p>Der User mit dem Namen $name ist bereits vorhanden.</p>");
    }

} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header ("Location: index.php");
    //echo "<a href='sign_up.php'>zum Signup</a>";
}
$con->close();

