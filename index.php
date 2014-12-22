<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if(isset($_SESSION['current_user_id'])){
    header ("Location: home.php");
}
    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Chat</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1>Ein kleiner, einfacher Chat</h1>
        
        <form action="login.php" method="post">
            <fieldset>
                <legend>Gib deinen Usernamen und dein Passwort ein:</legend>
                <p>
                    <label>Username</label><br>
                    <input type="text" name="username">
                </p>
                <p>
                    <label>Passwort </label><br>
                    <input type="password" name="password">
                </p>
                <p>
                    <button type="submit" name="btn_send">Einloggen</button>
                </p>
            </fieldset>
                
        </form>
        
        <fieldset>
            <legend>Noch keinen Account? Registriere dich hier</legend>
            <a href="sign_up.php">Registrieren</a>
        </fieldset>
        <?php

        if(isset($_SESSION['error'])){
            echo "<p class='error'>".$_SESSION['error']."</p>";
            unset($_SESSION['error']);
        }
        if(isset($_SESSION['message'])){
            echo "<p class='message'>".$_SESSION['message']."</p>";
            unset($_SESSION['message']);
        }
        ?>
    </body>
</html>
