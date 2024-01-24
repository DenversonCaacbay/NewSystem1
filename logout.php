<?php 
    require_once('classes/main.class.php');
    $bmis->logout();
    header("Location: login.php");
?>