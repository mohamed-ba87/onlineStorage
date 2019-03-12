<?php
session_start();
$db = mysqli_connect('CSDM-WEBDEV','1808234','1808234','db1808234_onlineStorage');
if (isset($_POST['register'])){
    $first= mysqli_real_escape_string($db,$_POST['first']);
    $last= mysqli_real_escape_string($db,$_POST['last']);
    $username= mysqli_real_escape_string($db,$_POST['username']);
    $email= mysqli_real_escape_string($db,$_POST['email']);
    $pass1= mysqli_real_escape_string($db,$_POST['password']);
    $pass2= mysqli_real_escape_string($db,$_POST['password_con']);

    if (empty($first) || empty($last) || empty($username) || empty($email) || empty($pass1) || empty($pass2)){
        header('location : registration.html?_empty');
        exit();
    }else {
        if ( ! preg_match("/^[a-zA-Z]*$/", $first) || ! preg_match("/^[a-zA-Z]*$/", $last)) {
            header('location : registration.html?first_last_not_right');
            exit();
        } else {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $sql2 = "SELECT * FROM login WHERE email='$email'";
                $result1 = mysqli_query($db, $sql2);
                $check1 = mysqli_num_rows($result1);

                if ($check1 != 0) {
                    header('location : registration.html?email=takenOr_notRight');
                    exit();
                } else {
                    $sql = "SELECT * FROM login WHERE username='$username'";
                    $result = mysqli_query($db, $sql);
                    $check = mysqli_num_rows($result);
                    if ($check != 0) {
                        header('location : registration.html?username=taken');
                        exit();
                    } else {
                        if ($pass1 != $pass2) {
                            header('location : registration.html?password_not_matched');
                            exit();
                        } else {
                            $password = password_hash($pass2, PASSWORD_DEFAULT);
                            $sql1 = "INSERT INTO login (username,email,password, type) VALUES ('$username','$email','$password',0)";
                            mysqli_query($db, $sql1);
                            $sql = "INSERT INTO user_info(username, first_name, last_name) VALUES ('$username','$first','$last')";
                            mysqli_query($db, $sql);
                            header('location : homePage.php');
                        }
                    }
                }
            }
        }

    }
}else{
    header('location : registration.html?noWay');
    exit();
}