<?php
session_start();
$dbhost="CSDM-WEBDEV";
$dbusername="1808234";
$dbpassword="1808234";
$dbname="";

$db = mysqli_connect('$dbhost','$dbusername','$dbpassword','$dbname');
if($db-> connect_error) {
    die('Error'.('.$db->connect_errno.'));
}