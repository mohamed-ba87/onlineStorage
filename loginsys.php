<?php
session_start();
include ('connection.php');

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
$errors = array();
if (isset($_POST['login'])){
    $username = mysqli_real_escape_string($db,$_POST['username']);
    $password = mysqli_real_escape_string($db,$_POST['password']);
    // doing checking if the user enter the right information

    if (empty($username)) { array_push($errors, "Username/Email is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }

    if(empty($username) || empty($password)){
        header('location: login.php?login=wrong_empty');
        exit();
    }else{
        // $pass=md5($password);AND password= '$pass
        $sql= "SELECT * FROM login WHERE username='$username' OR email= '$username'";
        $result = mysqli_query($db,$sql);
        $check= mysqli_num_rows($result);

        if ($check !=1){
            array_push($errors, "");

            header('location: login.php?login=wrong_sql_NotThere');
            exit();
        }else{

                if ($row = mysqli_fetch_assoc($result)){
                    $type= $row['types'];
                    if ($row['types']==1){
                        $password2= password_verify($password,$row['password']);
                        if ($password2==false){

                            array_push($errors, "Was wrong Password");

                            header('location: login.php?pass=password_wrong_user');
                            exit();
                        }elseif ($password2==true){
                            $_SESSION['username']=$row['username'];
                            $_SESSION['email']=$row['email'];
                            $user= $row['username'];
                            $sql1= "SELECT * FROM user_info WHERE username='$user'";
                            $result1 = mysqli_query($db,$sql1);
                            $check1= mysqli_num_rows($result1);
                            $rows = mysqli_fetch_assoc($result1);
                            $_SESSION['first']=$rows['first_name'];
                            $_SESSION['last']=$rows['last_name'];
                            header('location : adminHomePage.php?login=success');
                            $_SESSION['allGood']= "you have logged in successfully";
                            header('location : adminHomePage.php?login=success');
                          //  header('location : adminHomePage.php?login=success');
                            exit();
                        }
                    }else{

                        if ($row['types']==0){
                            $password2= password_verify($password,$row['password']);
                            if ($password2==false){
                                array_push($errors, "Was wrong Password");
                                header('location: login.php?password_wrong_user');
                                exit();
                            }elseif ($password2==true){

                                $_SESSION['username']=$row['username'];
                                $_SESSION['email']=$row['email'];
                                $user= $row['username'];
                                $sql1= "SELECT * FROM user_info WHERE username='$user'";
                                $result1 = mysqli_query($db,$sql1);
                                $check1= mysqli_num_rows($result1);
                                $rows = mysqli_fetch_assoc($result1);
                                $_SESSION['first']=$rows['first_name'];
                                $_SESSION['last']=$rows['last_name'];
                                header('location : userProfile.php?login=success');
                                $_SESSION['allGood']= "you have logged in successfully";
                                exit();
                            }
                        }else{
                            array_push($errors, "user not exist on the system please register first");
                            echo "user not exist on the system please register first";
                            header('location : register.php?user_not_exits');
                        }

                    }

                }else{
                    array_push($errors, "user not exist on the system please register first");
                    header('location: login.php?userNotExist');
                    exit();
                }
            }

        }
}else{
    array_push($errors, "the was login error Please try again");
    header('location: login.php?login=error');
    exit();
}
/*
session_start();
include ('connection.php');
if (isset($_POST['login'])){

    $username= mysqli_real_escape_string($db,$_POST['username']);
    $pass= mysqli_real_escape_string($db,$_POST['password']);
    if (empty($username) || empty($pass)){
        header('location : register.php?user_password_empty');
        exit();
    }else{
        $user= "SELECT * FROM users WHERE username='$username' OR email= '$username'";
        $res=mysqli_query($db,$user);
        $check= mysqli_num_rows($res);
        if ($check != 0){
            header('location: register.php?username=notRight');
            exit();
        }else{
            if ($row = mysqli_fetch_assoc($res)){
                $password= password_verify($pass,$row['password']);
                if ($password==false){
                    header('location: register.php?password_wrong');
                    exit();
                }elseif ($password==true){
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['first_name'] = $row['first_name'];
                    $_SESSION['last_name'] = $row['last_name'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['username'] = $row['username'];
                    header('location: index.html?login==success');
                    exit();
                }
            }
        }
    }
}else{
    header('location : register.php?you_need_to_register');
    exit();
}*/