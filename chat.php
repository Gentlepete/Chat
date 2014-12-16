<?php
session_start();
require_once 'db_connection.php';
$con = new Db();
if ($user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING))
{
    $_SESSION['user_id'] = $user_id;
}
$user = $con->getChatPartner($_SESSION['user_id']);

if(isset($_POST['btn_send']))
{
    $res = $con->sendMessage($user[0]['id']);
}

$messages = $con->getMessages($user[0]['id']);
$con->close();

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Chat</title>
    </head>
    <body>
        <?php 
        
        
        ?>
        <h1>Dein persönlicher Chat mit <?php echo $user[0]['name'] ?></h1>
        <a href="home.php">Zurück</a>
        <div style="border: 1px solid black;width: 300px;height: 500px;margin-left: 100px;">
            <div style="border: 1px solid black;height: 90%; overflow: auto;">
                <?php
                foreach ($messages as $message)
                {
                    echo "<p>"
                    . $message['name'] . $message['timestamp']
                    ."<br>"
                    . $message['text']
                    ."</p>";
                }
                ?>
            </div>
            <div style="padding: 10px 5px 0px 5px;border: 1px solid black;height: 10%;">
                
                <form action="chat.php" method="post">
                    <input style="width:200px; height: 20px" name="message">
                    <button style="height:25px;" type="submit" name="btn_send">Senden</button>
                </form>
                
            </div>
        </div>
        
        <?php
        
        // put your code here
        ?>
    </body>
</html>
