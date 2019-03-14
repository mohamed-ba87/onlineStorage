<?php
include ('../connection.php');
session_start();

if (isset($_POST['delete'])){
    $username= mysqli_real_escape_string($db,$_POST['de']);

    $sql= "SELECT * FROM login WHERE username='$username' OR email='$username'";
    $check = mysqli_query($db,$sql);
    $ck= mysqli_num_rows($check);

    if ($ck!= 1){
        header('location : ../adminHomePage.php?user=not_existed');
        echo "user not in our record";
        exit();
    }else{
        $de= "DELETE FROM login,user_info WHERE username = '$username' OR email= '$username'";
        $delete = mysqli_query($db,$de);
        header('location : ../adminHomePage.php');
        echo "user was deleted";
        exit();
    }
}else{
    header('location : ../adminHomePage.php');
    exit();
}
