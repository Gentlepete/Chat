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
    </head>
    <body>
        <a href="logout.php">Lougout</a>
        <h1>Deine Home Seite</h1>
        
        <!-- Div mit allen auf der Seite registrierten Usern als Links -->
        <div style="margin-right: 20px;float:left;border: 1px solid black;width: 150px;height: 500px;">
            
          Hier werden Die User aufgelistet
          
        </div>
        
        <!-- ContainerDiv für PostForm und Postings -->
        <div style="float: left;border: 1px solid black; width: 400px;height:500px;">
            
            <!-- ContainerDiv für PostForm -->
            <div style="border: 1px solid black;height: 12%;">
                
                <form action="post.php" method="post">
                    <input style="width:300px; height: 50px" name="post">
                    <input style="height:40px;" type="submit" value="Posten">
                </form>
                
            </div>    
            
            <!-- ContainerDiv für Postings -->
            <div style="border: 1px solid black;height: 87%;overflow: auto;">
                
                Hier werden die geposteten Beiträge angezeigt
                
            </div>  
            
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
