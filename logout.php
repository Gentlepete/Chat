<?php
session_start();
unset($_SESSION['current_user_id']);
header ("Location: index.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

