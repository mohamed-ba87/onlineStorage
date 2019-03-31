<?php
session_start();
include "../connection.php";
if (isset($_POST['rest_password'])){

    $selector=  bin2hex(random_bytes(8));
    $token=bin2hex(random_bytes(32));

    $url= "here we put our like or url that we need to send the user to/?selector=".$selector."token".$token;

    $time= date("U")+1800;

    $userEmail=mysqli_real_escape_string($db,$_POST['email']);
    $q=" SELECT email FROM login WHERE email='$userEmail'";
    $sq=mysqli_query($db,$q);
    $check= mysqli_num_rows($sq);
    if ($check!=1){
        header('location : login.php?username_email_not_exist');
        exit();
    }else{
        $sql= "DELETE FROM restpassword WHERE email=(?)";
        $stmt= mysqli_stmt_init($db);
        if (! mysqli_stmt_prepare($stmt,$sql)){
            echo "there was an Error" ;
            header('location : login.php?the_is_error');
        }else{
            mysqli_stmt_bind_param($stmt,"s",$userEmail);
            mysqli_stmt_execute($stmt);
        }
    }

    $my= "INSERT INTO restpasswoed (email,selector,token,expires) values (?,?,?,?)";
    $in=mysqli_stmt_init($db);
    if ( ! mysqli_stmt_prepare($in,$my)){
        echo "there was an error";
        exit();
    }else{
        $hashToken=password_hash($token,PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($in,"ssss",$userEmail,$selector,$hashToken,$time);
        mysqli_stmt_execute($in);
    }
    $to= $userEmail;
    $subject= "reset your password";
    $massage = "<p>the link to reset your password is below. If you did not make that request please ignore this email</p>";
    $massage .="<p>Here is your password link, Please follow the information in the link !<br>";
    $massage .="<a href='.$url.'>'. $url.'</a></p>";

    $header= "form:online Storage<onlinestorage.com>\r\n";
    $header .="content-type : text/html\r\n";

    email($to,$subject,$massage,$header);

    header('location : ../login.php');

}else{
    header('location : ../login.php');
}