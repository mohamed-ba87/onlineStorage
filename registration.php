<?php
session_start();
include 'connection.php';
if (isset($_POST['register'])){

    $first= mysqli_real_escape_string($db,$_POST['first']);
    $last= mysqli_real_escape_string($db,$_POST['last']);
    $username= mysqli_real_escape_string($db,$_POST['username']);
    $email= mysqli_real_escape_string($db,$_POST['email']);
    $pass1= mysqli_real_escape_string($db,$_POST['password']);
    $pass2= mysqli_real_escape_string($db,$_POST['password_con']);
    if (empty($first) || empty($last) || empty($username) || empty($email) || empty($pass1) || empty($pass2)){
        header('location: register.html?some_are_empty');
        exit();
    }else {
        if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
            header('location: register.html?first_last=notRight');
            exit();
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $sql2 = "SELECT * FROM users WHERE email='$email'";
                $result1 = mysqli_query($db, $sql2);
                $check1 = mysqli_num_rows($result1);
                if ($check1 != 0) {
                    header('location: register.html?email=takenOr_notRight');
                    exit();
                } else {
                    $sql = "SELECT * FROM users WHERE username='$username'";
                    $result = mysqli_query($db, $sql);
                    $check = mysqli_num_rows($result);
                    if ($check != 0) {
                        header('location: register.html?username=taken');
                        exit();
                    } else {
                        if ($pass1 != $pass2) {
                            header('location: register.html?password_not_matched');
                            exit();
                        } else {
                            $password = password_hash($pass2, PASSWORD_DEFAULT);
                            $sql1 = "INSERT INTO users (first_name,last_name,username,email,password) VALUES ('$first','$last','$username','$email','$password')";
                            mysqli_query($db, $sql1);
                            header('location : homePage.php');
                        }
                    }
                }
            }
        }

    }
}else{
    header('location: register.html');
    exit();
}