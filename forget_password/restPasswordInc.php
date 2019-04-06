<?php
session_start();
include ('../connection.php');
if (isset($_POST['rest_pass_sub'])){

    $selector= mysqli_real_escape_string($db,$_POST['selector']);
    $validator= mysqli_real_escape_string($db,$_POST['validator']);
    $pass1= mysqli_real_escape_string($db,$_POST['pwd']);
    $pass2= mysqli_real_escape_string($db,$_POST['con_pwd']);

    if (empty($pass1) || empty($pass2)){
        header('location : ../createNewPassword.php');
        exit();
    }else{
        if ($pass1!= $pass2){
            header('location : ../createNewPassword.php');
            exit();
        }else{
            $current= date("U");
            $sql= "SELECT * FROM restpassword WHERE selector = ? AND expires >= '$current'";
            $stmt=mysqli_stmt_init($db);
            if ( ! mysqli_stmt_prepare($stmt,$sql)){
                echo "there was an error";
                exit();
            }else{

                mysqli_stmt_bind_param($stmt,"ss",$selector,$current);
                mysqli_stmt_execute($stmt);

                $res= mysqli_stmt_get_result($stmt);
                if (! $row= mysqli_fetch_assoc($res)){
                    header('../login.php?error=restPassword');
                    echo " can not complete this process";
                    exit();
                }else{
                    $tokenBin= hex2bin($validator);
                    $tokenCheck = password_verify($tokenBin,$row['token']);
                    if ($tokenCheck==false){
                        echo "not verified information ";
                    } elseif ($tokenCheck ==true){
                        $tokenEmail= $row['email'];
                        $sqli= "SELECT * FROM login WHERE email=?";
                        $stmt=mysqli_stmt_init($db);
                        if ( ! mysqli_stmt_prepare($stmt,$sqli)){
                            echo "there was an error";
                            exit();
                        }else{
                            mysqli_stmt_bind_param($stmt,"s",$tokenEmail);
                            mysqli_stmt_execute($stmt);
                            $result= mysqli_stmt_get_result($stmt);
                            if (! $rows= mysqli_fetch_assoc($result)){
                                header('');
                                echo "";
                                exit();
                            }else{

                                $up= " UPDATE login SET password= ? WHERE email= ?";
                                $stmts=mysqli_stmt_init($db);
                                if ( ! mysqli_stmt_prepare($stmts,$up)){
                                    echo "there was an error";
                                    exit();
                                }else{
                                    $newPwd= password_hash($pass2,PASSWORD_DEFAULT);
                                    mysqli_stmt_bind_param($stmt,"ss",$newPwd,$tokenEmail);
                                    mysqli_stmt_execute($stmts);

                                    // delete token from the data base
                                    $sqld= "DELETE FROM restpassword WHERE email=(?)";
                                    $stmtd= mysqli_stmt_init($db);
                                    if (! mysqli_stmt_prepare($stmtd,$sqld)){
                                        echo "there was an Error" ;
                                        header('location : login.php?the_is_error');
                                    }else{
                                        mysqli_stmt_bind_param($stmtd,"s",$userEmail);
                                        mysqli_stmt_execute($stmtd);
                                        header('location : ../login.php?new+pwd==passwordUpdated');
                                    }

                                }

                            }
                        }
                    }
                }
            }
        }
    }

}else{
    header('');

}