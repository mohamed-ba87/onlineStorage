<?php
session_start();
$db = mysqli_connect('localhost','root','','users');
if (isset($_POST['login'])){

    $username= mysqli_real_escape_string($db,$_POST['username']);
    $pass= mysqli_real_escape_string($db,$_POST['password']);
    if (empty($username) || empty($pass)){
        header('location : login.html?user_password_empty');
        exit();
    }else{
        $user= "SELECT * FROM login WHERE username='$username' || email= '$username'";
        $res=mysqli_query($db,$user);
        $check= mysqli_num_rows($res);

        if ($check != 1){
            header('location: login.html?username=notRight');
            exit();
        }else{
            if ($row = mysqli_fetch_assoc($res)){
                $password= password_verify($pass,$row['password']);

                if ($password==false){
                    header('location: login.html?password_wrong');
                    exit();
                }elseif ($password==true){
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['first_name'] = $row['first_name'];
                    $_SESSION['last_name'] = $row['last_name'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['username'] = $row['username'];
                    print ($_SESSION['username']);
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