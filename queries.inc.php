<?php

require_once 'db_connection.php';
$con = new Db();

$users = $con->getUsers();

$con->close();
