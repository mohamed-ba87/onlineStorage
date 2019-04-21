<?php
session_start();
include ('../connection.php');
if (isset($_POST['add_user'])){
    $first= mysqli_real_escape_string($db,$_POST['first']);
    $last= mysqli_real_escape_string($db,$_POST['last']);
    $username= mysqli_real_escape_string($db,$_POST['username']);
    $email= mysqli_real_escape_string($db,$_POST['email']);
    $pass1 = mysqli_real_escape_string($db,$_POST['password']);
    $pass2 = mysqli_real_escape_string($db,$_POST['password_con']);

    // checking time lool
    if (empty($first) || empty($last) || empty($pass1)  || empty($pass2)  || empty($username)  || empty($email)){
        header('location : ../adminHomePage.php?user=empty');
        exit();
    }else {

        if (! preg_match("/^[a-zA-Z]*$/", $first) || ! preg_match("/^[a-zA-Z]*$/", $last)) {
            header('location : ../adminHomePage.php?first_last=error');
            exit();
        } else {
            if (! filter_var($email,FILTER_VALIDATE_EMAIL)){
                header('location: ../adminHomePage.php?email=error');
                exit();
            }else{
                $check_user = "SELECT * FROM login WHERE username= '$username' OR email='$email' ";
                $result = mysqli_query($db, $check_user);
                $get = mysqli_num_rows($result);
                if ($get != 0) {
                    header('location: ../adminHomePage.php?email_username=taken');
                    exit();
                }else{
                    if ($pass1 != $pass2){
                        header('location: ../adminHomePage.php?password=not_match');
                        exit();
                    }else{
                        $type= mysqli_real_escape_string($db,$_POST['user_type']);
                        if ( preg_match('/^[Add Administrator]*$/',$type)){
                        $password = password_hash($pass2, PASSWORD_DEFAULT);// HASH the password
                        // insert the login data into login table
                        $sql= "INSERT INTO login (username,email,password,types) VALUES ('$username','$email','$password',1)";
                        $res=mysqli_query($db,$sql);

                        // insert the administrator personal information into user_info table
                        $sql_user= "INSERT INTO user_info (username,first_name,last_name) VALUES ('$username', '$first','$last')";
                        mysqli_query($db,$sql_user);
                            $_SESSION['user_add']= $username;
                            $_SESSION['success'] = "new Admin was added successfully"." ".$username;
                        header('location : ../adminHomePage.php?new_user=added');
exit();
                        }else{
                            if ( preg_match('/^[Add User]*$/',$type)){
                                $password = password_hash($pass2, PASSWORD_DEFAULT);// HASH the password
                            $sql= "INSERT INTO login (username,email,password,types) VALUES ('$username','$email','$password',0)";
                            $res=mysqli_query($db,$sql);
                            // insert the user info table
                            $sql_user= "INSERT INTO user_info (username,first_name,last_name) VALUES ('$username', '$first','$last')";
                            mysqli_query($db,$sql_user);
                            $_SESSION['user_add']= $username;
                            header('location : ../adminHomePage.php?new_user=added');
                            }else{
                                echo "this user type not right ";
                                header('location : ../adminHomePage.php');
                            }
                        }

                    }
                }

            }
        }
    }
}else{
    header('location: ../adminHomePage.php');
    exit();
}