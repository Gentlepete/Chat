<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
var_dump($_SESSION);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Chat</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1>Ein kleiner, einfach Chat</h1>
        
        <form action="login.php" mehod="post">
            <fieldset>
                <legend>Gib deinen Usernamen und dein Passwort ein:</legend>
                <p>
                    <label>Username </label>
                    <input name="username">
                </p>
                <p>
                    <label>Passwort </label>
                    <input type="password" name="password">
                </p>
                <p><input type="submit"></p>
            </fieldset>
                
        </form>
        
        <fieldset>
            <legend>Noch keinen Account? Regisrtiere dich hier</legend>
            <a href="sign_up.html">Registrieren</a>
        </fieldset>
        <?php
        //var_dump($_POST);
        if(isset($_SESSION['error']))
        {
            echo "<p>".$_SESSION['error']."</p>";
            unset($_SESSION['error']);
        }
        ?>
    </body>
</html>
