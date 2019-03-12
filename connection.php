<?php
//session_start();
$dbhost="";
$dbusername="1808234";
$dbpassword="1808234";
$dbname="";

// localhost connection information:
$local="localhost";
$user="root";
$pass="";
$DB_name= "users";

$db = mysqli_connect('localhost','root','','users');
if($db-> connect_error) {
    die('Error'.('.$db->connect_errno.'));
}