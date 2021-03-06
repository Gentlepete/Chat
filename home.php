<?php
require_once 'db_connection.php';
session_start();
$con = new Db();
$users = $con->getUsers();

if (isset($_POST['btn_send']))
{
    $con->doPost();
}
$posts = $con->getPosts();
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
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        
        <?php
        if(!isset($_SESSION['current_user_id']))
        {
            header("Location: index.php");
        }
        if(isset($_SESSION['message']))
        {
            echo "<p class='message'>".$_SESSION['message']."</p>";
            unset($_SESSION['message']);
        }
        echo $_SESSION['current_user_id'];
        ?>
        
        <a href="logout.php">Logout</a>
        <h1>Deine Home Seite</h1>
        
        <!-- Div mit allen auf der Seite registrierten Usern als Links -->
        <div style="margin-right: 20px;float:left;border: 1px solid black;width: 150px;height: 500px;">
            <!--<form action="chat.php" method="post">-->    
                <?php
                foreach($users as $user)
                {
                    if ($user['id'] != $_SESSION['current_user_id']){
                       echo "<p><a href='chat.php?user_id=".$user['id']."'>".ucfirst($user['name'])."</a></p>";
                       //echo "<button class='btn_user' type='submit' value='".$user['id']."' name='user_id'>".$user['name']."</button><br>";
                    }
                }
                ?>
            <!--</form>-->
        </div>
        
        <!-- ContainerDiv für PostForm und Postings -->
        <div style="float: left;border: 1px solid black; width: 400px;height:500px;">
            
            <!-- ContainerDiv für PostForm -->
            <div style="border: 1px solid black;height: 12%;">
                
                <form action="home.php" method="post">
                    <input type="text" style="width:300px; height: 50px" name="post">
                    <button style="height:40px;" type="submit" name="btn_send">Post</button>
                </form>
                
            </div>    
            
            <!-- ContainerDiv für Postings -->
            <div style="border: 1px solid black;height: 87%;overflow: auto;">
                <!--<pre>-->
                    <?php
                    if($posts){
                        foreach ($posts as $post){
                            $posts_output = "";
                            $posts_output .= "<p>";
                            $posts_output .= "<span class='DateTime'>";
                            $posts_output .= date('d M Y ', strtotime($post['timestamp']));
                            $posts_output .= " - </span>";
                            $posts_output .= "<span class='UserName' ";
                            if($post['id'] == $_SESSION['current_user_id']){
                                $posts_output .= "style='color:green'>".ucfirst($post['name']).":";
                            }else{
                                $posts_output .= "><a href='chat.php?user_id=".$post['id']."'>".ucfirst($post['name']).":</a>";
                            }
                            $posts_output .= "</span> ";
                            $posts_output .= "<span class='UserPost'>";
                            $posts_output .= trim($post['message']);
                            $posts_output .= "</span>";
                            $posts_output .= "</p>";
                            echo $posts_output;
                        }
                    }

                    ?>
                <!--</pre>-->
            </div>  
            
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
