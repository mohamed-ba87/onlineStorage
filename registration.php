<?php
session_start();
include ('connection.php');

$errors = array();
if (isset($_POST['register'] )){

    $first= mysqli_real_escape_string($db,$_POST['first']);
    $last= mysqli_real_escape_string($db,$_POST['last']);
    $username= mysqli_real_escape_string($db,$_POST['username']);
    $email= mysqli_real_escape_string($db,$_POST['email']);
    $pass1 = mysqli_real_escape_string($db,$_POST['password']);
    $pass2 = mysqli_real_escape_string($db,$_POST['password_con']);


    if (empty($first)) { array_push($errors, "first name is required"); }
    if (empty($last)) { array_push($errors, "last name is required"); }
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($pass1)) { array_push($errors, "Password is required"); }

    // checking time lool
    if (empty($first) || empty($last)   || empty($username)  || empty($email) || empty($pass1)  || empty($pass2)){
        header('location: register.php?empty');
        exit();
    }else {

        if (! preg_match("/^[a-zA-Z]*$/", $first) || ! preg_match("/^[a-zA-Z]*$/", $last)) {
            array_push($errors, "first/last name not right...");
            header('location: register.php?first_last=error');
            exit();
        } else {
                if (! filter_var($email,FILTER_VALIDATE_EMAIL)){
                    array_push($errors, "Wrong email, Please enter the right email");
                    header('location: register.php?email=error');
                    exit();
                }else{
                    $check_user = "SELECT * FROM login WHERE username= '$username' OR email='$email' ";
                    $result = mysqli_query($db, $check_user);
                    $get = mysqli_num_rows($result);
                    if ($get != 0) {
                        array_push($errors, "Sorry username/email was taken try again..!");
                        header('location: register.php?email_username=taken');
                        exit();
                    }else{
                        if ($pass1 != $pass2){
                            array_push($errors, "the password was not match try again..!");
                            header('location: register.php?password=not_match');
                            exit();
                        }else{
                            $password = password_hash($pass2, PASSWORD_DEFAULT);// HASH the password
                            // insert the login data into login table
                            $sql_login= "INSERT INTO  login (username, email, password, types) VALUES ('$username','$email','$password',0)";
                            $res=mysqli_query($db,$sql_login);

                            // insert the tradesman data into tradesman table
                            $sql_user= "INSERT INTO user_info (username,first_name,last_name) VALUES ('$username', '$first','$last')";
                            mysqli_query($db,$sql_user);

                            $_SESSION['user']= $username;
                            header('location : register.php?login=success');

                        }
                    }

                }
            }
    }
}else{
    header('location: register.php');
    exit();
}













/*
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

$db = mysqli_connect('CSDM-WEBDEV ','1808234','1808234','db1808234_onlineStorage');

if (isset($_POST['register'])) {

    $first = mysqli_real_escape_string($db, $_POST['first']);
    $last = mysqli_real_escape_string($db, $_POST['last']);
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass1 = mysqli_real_escape_string($db, $_POST['password']);
    $pass2 = mysqli_real_escape_string($db, $_POST['password_con']);

    print_r($last);
    exit();
    if (empty($first) || empty($last) || empty($username) || empty($email) || empty($pass1) || empty($pass2)) {
        header('location: register.php?some_are_empty');
        exit();
    }

    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username)){
        header('location: register.php?username_or_email=not_Valid');
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location: register.php?email=not_Valid');
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/",$username)){
        header('location: register.php?username=not_Valid');
        exit();
    }
    else if  ($pass1 != $pass2) {
        header('location: ../register.php?password_not_matched');
        exit();
    }
    else{

        $sql = "SELECT * FROM login WHERE username= ? AND email= ?";
        $stmt= mysqli_stmt_init($db);

        if (! mysqli_stmt_prepare($stmt,$sql)){
            header('location : register.php?sql_error');
            exit();
        }else{
            mysqli_stmt_bind_param($stmt,"ss",$username,$email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $check = mysqli_stmt_num_rows($stmt);

            if ($check != 0){
                header('location : register.php?email_username=taken');
                exit();
            }
            else{
                $sql1 = "INSERT INTO login( username,email,password,types) values (?,?,?,1)";
                $stmt= mysqli_stmt_init($db);
                if (! mysqli_stmt_prepare($stmt,$sql)){
                    header('location : register.php?insert_error');
                    exit();
                }else{
                    $password = password_hash($pass2, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt,"sss1",$username,$email,$password,1);
                    mysqli_stmt_execute($stmt);

                    $sql2 = "INSERT INTO login( username,email,password,types) values (?,?,?,1)";
                    $stmt= mysqli_stmt_init($db);
                    mysqli_stmt_bind_param($stmt,"sss",$username,$first,$last);
                    mysqli_stmt_execute($stmt);

                }
            }
        }
    }
   // mysqli_stmt_close($stmt);
}//else{
   // header('location: register.php');
    //exit();
//}

    /*else {
        if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
            header('location: register.php?first_last=notRight');
            exit();
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $sql2 = "SELECT * FROM login WHERE email='$email'";
                $result1 = mysqli_query($db, $sql2);
                $check1 = mysqli_num_rows($result1);
                if ($check1 != 0) {
                    header('location: register.php?email=takenOr_notRight');
                    exit();
                } else {
                    if (!preg_match("/^[a-zA-Z0-9]*$/",$username)){
                        header('location: register.php?username=must_have_number');
                        exit();
                    }
                    else{
                        $sql = "SELECT * FROM login WHERE username='$username'";
                        $result = mysqli_query($db, $sql);
                        $check = mysqli_num_rows($result);
                        if ($check != 0) {
                            header('location: ../register.php?username=taken');
                            exit();
                        } else {
                            if ($pass1 != $pass2) {
                                header('location: ../register.php?password_not_matched');
                                exit();
                            } else {
                                $password = password_hash($pass2, PASSWORD_DEFAULT);
                                $sql1 = "INSERT INTO login (username,email,password,types) VALUES ('$username','$email','$password',0)";
                                mysqli_query($db, $sql1);
                                $sql = "INSERT INTO user_info (username,first_name,last_name) VALUES ('$username','$first','$last')";
                                mysqli_query($db, $sql);
                                header('location : ../homePage.php');
                            }
                        }
                    }

                }
            }
        }

    }
}else{
    header('location: ../register.php');
    exit();
}*/