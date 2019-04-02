<?php
session_start();
include ('connection.php');
if (isset($_POST['btn_search'])){

    $search = mysqli_real_escape_string($db,$_POST['search']);

    if (empty($search)){

        header('location: userProfile.php?search=empty');
        exit();
    }else{

        $sql= "SELECT * FROM login,user_info WHERE login.username = user_info.username AND  (login.username LIKE '$search' OR login.email LIKE '$search')";
        $sqlSearch= mysqli_query($db,$sql);

        if (mysqli_num_rows($sqlSearch)>!0){
            header('location: userProfile.php?search=nothing');
            exit();
        }else{

            while ($row= mysqli_fetch_assoc($sqlSearch)){


                $row['username'];


            }
        }
    }

}