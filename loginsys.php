<?php
session_start();
include ('connection.php');

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

if (isset($_POST['login'])){
    $username = mysqli_real_escape_string($db,$_POST['username']);
    $password = mysqli_real_escape_string($db,$_POST['password']);
    // doing checking if the user enter the right information
    if(empty($username) || empty($password)){
        header('location: login.php?login=wrong_empty');
        exit();
    }else{
        // $pass=md5($password);AND password= '$pass
        $sql= "SELECT * FROM login WHERE username='$username' OR email= '$username'";
        $result = mysqli_query($db,$sql);
        $check= mysqli_num_rows($result);
        //  print_r($check);
        //exit();
        if ($check !=1){
            header('location: login.php?login=wrong_sql_NotThere');
            exit();
        }else{

                if ($row = mysqli_fetch_assoc($result)){
                    $type= $row['type'];
                    if ($row['type']==1){
                        $password2= password_verify($password,$row['password']);
                        if ($password2==false){
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
                            header('location : adminHomePage.php?login=success');
                            $_SESSION['allGood']= "you have logged in successfully";
                            exit();
                        }
                    }else{

                        if ($row['type']==0){
                            $password2= password_verify($password,$row['password']);
                            if ($password2==false){
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
                                header('location : userHomePage?login=success');
                                $_SESSION['allGood']= "you have logged in successfully";
                                exit();
                            }
                        }else{
                            echo "user not exist on the system please register first";
                            header('location : register.html?user_not_exits');
                        }

                    }

                }else{
                    header('location: login.php?userNotExist');
                    exit();
                }
            }

        }
}else{
    header('location:  ../mainpage.php?login=error');
    exit();
}
/*
session_start();
include ('connection.php');
if (isset($_POST['login'])){

    $username= mysqli_real_escape_string($db,$_POST['username']);
    $pass= mysqli_real_escape_string($db,$_POST['password']);
    if (empty($username) || empty($pass)){
        header('location : register.html?user_password_empty');
        exit();
    }else{
        $user= "SELECT * FROM users WHERE username='$username' OR email= '$username'";
        $res=mysqli_query($db,$user);
        $check= mysqli_num_rows($res);
        if ($check != 0){
            header('location: register.html?username=notRight');
            exit();
        }else{
            if ($row = mysqli_fetch_assoc($res)){
                $password= password_verify($pass,$row['password']);
                if ($password==false){
                    header('location: register.html?password_wrong');
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
    header('location : register.html?you_need_to_register');
    exit();
}