<?php

require_once 'db_connection.php';
$con = new connection();
$con->connect();

$all_users = "SELECT * FROM user";
$user_result = $con->query($all_users);

$users = $con->get_query_data($user_result);


$all_posts = "SELECT post.message, post.timestamp, user.name FROM post JOIN user ON user.id = post.user_id ORDER BY post.timestamp DESC";
$post_result = $con->query($all_posts);

$posts = $con->get_query_data($post_result);


$con->close();
