<?php
session_start();
require_once 'db_connection.php';
if (isset($_POST["btn_send"]))
{    
    //$_SESSION['error'] = "reggh";
    $con = new Db();
    $con->signUp();  
    $con->close();
}

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Registrieren</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1>Registrierung</h1>
        <?php
        if(isset($_SESSION['error']))
        {
            echo "<p class='error'>".$_SESSION['error']."</p>";
            unset($_SESSION['error']);
        }
        if(isset($_SESSION['message']))
        {
            echo "<p class='message'>".$_SESSION['message']."</p>";
            unset($_SESSION['message']);
        }
        ?>
        <form action="sign_up.php" method="post">
            <fieldset>
                <legend>Bitte wähle Username und Passwort:</legend>
                <p>
                    <label>Username</label>
                    <input type="text" name="username" />
                </p>
                <p>
                    <label>Passwort</label>
                    <input type="password" name="password_1" />
                </p>
                <p>
                    <label>Passwort wiederholen</label>
                    <input type="password" name="password_2" />
                </p>
                <p><button type="submit" name="btn_send">Anlegen</button></p>
            </fieldset>
        </form>
        
        <a href="index.php">Zurück zur Startseite</a>
    </body>
</html>
