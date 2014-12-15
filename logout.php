<?php
session_start();
unset($_SESSION['current_user_id']);
$_SESSION['message'] = "Sie wurden ausgeloggt";
header ("Location: index.php");
