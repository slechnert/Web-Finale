<?php
session_start();
//var_dump($_SESSION)
if(!isset($_SESSION['username'])){
    header('Location: index.php');
    exit();}
?>