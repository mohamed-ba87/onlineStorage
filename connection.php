<?php
$dbhost="CSDM-WEBDEV ";
$dbusername="1808234";
$dbpassword="1808234";
$dbname="db1808234_onlineStorage";

// localhost connection information:
$local="localhost";
$user="root";
$pass="";
$DB_name= "users";

$db = mysqli_connect('CSDM-WEBDEV ','1808234','1808234','db1808234_onlineStorage');
if($db-> connect_error) {
    die('Error'.('.$db->connect_errno.'));
}