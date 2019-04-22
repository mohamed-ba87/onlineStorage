<?php
session_start();
include ('connection.php');
if (isset($_POST['update'])){
    $username = $_SESSION['username'];
    $first=mysqli_real_escape_string($db,$_POST['first']);
    $last=mysqli_real_escape_string($db,$_POST['last']);

    if (! empty($first) ||! empty($last) ){
        // $users= mysqli_query($db,$user);
        $user1= "UPDATE login SET first_name='$first',last_name='$last' WHERE username='$username'";
        $users1= mysqli_query($db,$user1);
        $sql1= "SELECT * FROM login WHERE username='$username'";
        $result1 = mysqli_query($db,$sql1);
     while ($rows = mysqli_fetch_assoc($result1)) {
         $_SESSION['firstUP'] = $rows['first_name'];
         $_SESSION['lastUP'] = $rows['last_name'];
     }
        header('location : userProfile.php?userU=good');
        $_SESSION['allGood']= "you have logged in successfully";
        exit();

    }else{

        header('location : userProfile.php?userU=error');
       // $_SESSION['allGood']= "you have logged in successfully";
        exit();
    }
}