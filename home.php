<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();

require_once 'queries.inc.php';
?>
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
        ?>
        <a href="logout.php">Logout</a>
        <h1>Deine Home Seite</h1>
        
        <!-- Div mit allen auf der Seite registrierten Usern als Links -->
        <div style="margin-right: 20px;float:left;border: 1px solid black;width: 150px;height: 500px;">
            <form action="chat.php" method="post">    
         <?php
                
         foreach($users as $user)
         {
             echo "<button type='submit' value='".$user['id']."' name='user_id'>".$user['name']."</button><br>";
             //echo "<p><a href='chat.php' id='".$user['id']."'>".$user['name']."</a></p>";
         }
         
         ?>
            </form>
            
          
        </div>
        
        <!-- ContainerDiv für PostForm und Postings -->
        <div style="float: left;border: 1px solid black; width: 400px;height:500px;">
            
            <!-- ContainerDiv für PostForm -->
            <div style="border: 1px solid black;height: 12%;">
                
                <form action="post.php" method="post">
                    <input type="text" style="width:300px; height: 50px" name="post">
                    <input style="height:40px;" type="submit" value="Posten">
                </form>
                
            </div>    
            
            <!-- ContainerDiv für Postings -->
            <div style="border: 1px solid black;height: 87%;overflow: auto;">
                
                <?php
                
                foreach ($posts as $post)
                {
                    echo "<p>";
                    echo $post['name']." ".$post['timestamp']."<br>";
                    echo $post['message'];
                    echo "</p>";
                } 
                
                            
                
                ?>
                
            </div>  
            
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
