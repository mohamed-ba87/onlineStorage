<?php

session_start();
include ('connection.php');

if (isset($_POST['sub_message'])){

    $username= mysqli_real_escape_string($db,$_POST['user_name']);
    $title= mysqli_real_escape_string($db,$_POST['title']);
    $message= mysqli_real_escape_string($db,$_POST['message']);

    if (empty($username) || empty($title) || empty($message)){
        header('location : messages.php?mess=empty');
        exit();
    }else{
        $sql= "SELECT * FROM login WHERE username ='$username' OR email='$username'";
        $query= mysqli_query($db,$sql);
        if (mysqli_num_rows($query) == 0){
            header('location : messages.php?mess=no');
            exit();
        }else {
            while ($row= mysqli_fetch_assoc($query)){
                $_SESSION['us']= $row['username'];
            }
            $file = $_FILES['message_image'];

            $filename = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];
            $fileSize = $file['size'];

            $fileExt = explode(".", $filename);

            $fileActExt = strtolower(end($fileExt));


                if (!empty($filename)&&$fileError === 0) {

                    if ($fileSize < 250000) {
                        $imageName = "." . uniqid("", true) . "." . $fileActExt;
                        $fileDestination = "C:/inetpub/wwwroot/1808234/onlineStore/messages_image/" . $imageName;
                    } else {
                        header('location : messages.php?mess=big');
                        exit();
                    }
                }


            $user_name= $_SESSION['us'];
            $sender= $_POST['sub_message'];
            $sql_in= "INSERT INTO messages (title,message,photo,from_user,to_user) VALUES ('$title','$message','$imageName','$sender','$user_name')";
            $query_in= mysqli_query($db,$sql_in);

            move_uploaded_file($fileTmpName,$fileDestination);
            $getId= mysqli_insert_id($db);

            $mo=$_SESSION['username'];

            $sql_in1= "INSERT INTO user_mail_box (username,mail_box , message_id) VALUES ('$user_name','in','$getId')";
            $query_in1= mysqli_query($db,$sql_in1);

            $sql_in2= "INSERT INTO user_mail_box (username,mail_box,message_id) VALUES ('$sender','out','$getId')";
            $query_in2= mysqli_query($db,$sql_in2);
            header('location : messages.php?mess=success');
            exit();
        }
    }

}
