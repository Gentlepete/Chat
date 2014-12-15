<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

session_start();
require_once 'db_connection.php';
$con = new connection();
$con->connect();
$cu_id = $_SESSION['current_user_id'];

$chat_partner_id = $_POST['user_id'];

$messagesql = "SELECT * FROM message WHERE send_user_id = $cu_id AND recieve_user_id = $chat_partner_id OR send_user_id = $chat_partner_id AND recieve_user_id = $cu_id ";
$message_result = $con->query($messagesql);

$messages = $con->get_query_data($message_result);

$con->close();

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Chat</title>
    </head>
    <body>
        <?php var_dump($_POST); ?>
        <h1>Dein persönlicher Chat mit [platzhalter]</h1>
        
        <div style="border: 1px solid black;width: 300px;height: 500px;margin-left: 100px;">
            <div style="border: 1px solid black;height: 90%;">
               <?php
               
               foreach($messages as $message)
               {
                   echo $message."<br>";
               }
               
               ?>
            </div>
            <div style="padding: 10px 5px 0px 5px;border: 1px solid black;height: 10%;">
                
                <form action="send_message.php" method="post">
                    <input style="width:200px; height: 20px" name="post">
                    <input style="height:25px;" type="submit" value="Senden">
                </form>
                
            </div>
        </div>
        <?php
        
        // put your code here
        ?>
    </body>
</html>
