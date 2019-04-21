<?php

session_start();
include ('connection.php');

if (isset($_POST['sub_message_admin'])){

    $username= mysqli_real_escape_string($db,$_POST['user_name']);
    $title= mysqli_real_escape_string($db,$_POST['title']);
    $message= mysqli_real_escape_string($db,$_POST['message']);

    if (empty($username) || empty($title) || empty($message)){
        header('location : adminMessages.php?mess=empty');
        exit();
    }else{
        $sql= "SELECT * FROM login WHERE username ='$username' OR email='$username'";
        $query= mysqli_query($db,$sql);
        if (mysqli_num_rows($query) == 0){
            header('location : adminMessages.php?mess=no');
            exit();
        }else {
            while ($row= mysqli_fetch_assoc($query)){
                $_SESSION['us_ad']= $row['username'];
            }

            $user_name= $_SESSION['us_ad'];
            $sender= $_POST['sub_message_admin'];
            $sql_in= "INSERT INTO messages (title,message,photo,from_user,to_user) VALUES ('$title','$message',NULL ,'$sender','$user_name')";
            $query_in= mysqli_query($db,$sql_in);
            $getId= mysqli_insert_id($db);


            $sql_in1= "INSERT INTO user_mail_box (username,mail_box , message_id) VALUES ('$user_name','in','$getId')";
            $query_in1= mysqli_query($db,$sql_in1);

            $sql_in2= "INSERT INTO user_mail_box (username,mail_box,message_id) VALUES ('$sender','out','$getId')";
            $query_in2= mysqli_query($db,$sql_in2);
            header('location : adminHomePage.php?mess=success');
            exit();
        }
    }

}
