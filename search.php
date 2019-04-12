<?php
session_start();
include ('connection.php');
if (isset($_POST['btn_search'])){
    $search = mysqli_real_escape_string($db,$_POST['search']);

    if (empty($search)){
        header('location: adminHomePage.php?search=empty');
        exit();
    }else{
        $sql= "SELECT * FROM login,user_info WHERE login.username = user_info.username AND  (login.username LIKE '$search' OR login.email LIKE '$search')";
        $sqlSearch= mysqli_query($db,$sql);
        $select= "SELECT setImage  FROM user_images WHERE username = '$search'";
        $ck=mysqli_query($db,$select);
        $_SESSION['size']= mysqli_num_rows($ck);
        if (mysqli_num_rows($sqlSearch) == 0){
            $_SESSION['result'] = "No results found in this username/email..";
            header('location: adminHomePage.php?search=nothing');
            exit();
        }else {

                while ($row = mysqli_fetch_assoc($sqlSearch)) {
                    $_SESSION['uname'] = $row['username'];
                    $_SESSION['em'] = $row['email'];
                    $_SESSION['first'] = $row['first_name'];
                    $_SESSION['last'] = $row['last_name'];
                }
            $_SESSION['result']= "result was fond:";
            header('location: adminHomePage.php?search=success');
            exit();
        }
    }
}



if (isset($_POST['btn_search_user'])){
    $search = mysqli_real_escape_string($db,$_POST['search_user']);

    if (empty($search)){
        header('location: userProfile.php?search=empty');
        exit();
    }else{
        $sql= "SELECT * FROM login,user_info WHERE login.username = user_info.username AND  (login.username LIKE '$search' OR login.email LIKE '$search')";
        $sqlSearch= mysqli_query($db,$sql);

        if (mysqli_num_rows($sqlSearch) == 0){
            $_SESSION['result'] = "No results found in this username/email..";
            header('location: userProfile.php?search=nothing');
            exit();
        }else {

            while ($row = mysqli_fetch_assoc($sqlSearch)) {
                $_SESSION['uname'] = $row['username'];
                $_SESSION['em'] = $row['email'];
                $_SESSION['first'] = $row['first_name'];
                $_SESSION['last'] = $row['last_name'];
            }
            $_SESSION['result']= "result was fond:";
            header('location: userProfile.php?search=success');
            exit();
        }
    }
}

