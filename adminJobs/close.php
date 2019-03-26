<?php
session_start();
if (isset($_POST['close'])){
    session_destroy();
    header('location : adminHomePage.php');
    exit();
}