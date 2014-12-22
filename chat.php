<?php
session_start();
if(!isset($_SESSION['current_user_id'])){
    $_SESSION['message'] = "Bitte vorher einloggen.";
    header("Location: index.php");
}
require_once 'db_connection.php';
$con = new Db();
if ($user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING))
{
    $_SESSION['user_id'] = $user_id;
}

//if(!$partner = $con->getChatPartner($_SESSION['user_id'])){
    $partner = $con->getChatPartner($_GET['user_id']);
//};

if(isset($_POST['btn_send']))
{
    $res = $con->sendMessage($partner[0]['id']);
}

$messages = $con->getMessages($partner[0]['id']);

$con->close();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Chat</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1>Dein persönlicher Chat mit <?php echo $partner[0]['name'] ?></h1>
        <a href="home.php">Zurück</a>
        <div style="border: 1px solid black;width: 300px;height: 500px;margin-left: 100px;">
            <div style="border: 1px solid black;height: 90%; overflow: auto;">
                <pre>
                    <?php
                    foreach ($messages as $message)
                    {
                        $message_output = "";
                        if($message['send_user_id'] == $_SESSION['current_user_id']){
                            $message_output .= "<p style=background-color:lightblue;>";
                        }else{
                            $message_output .= "<p>";
                        }
                        $message_output .= $message['name'] . " "
                            ."<span style='font-size:8px;color:grey;'>"
                            .$message['timestamp']."</span></p>"
                            ."<p>"    
                            .$message['text']."</p>";
                        echo $message_output;
                    }
                    ?>              
                </pre>
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
