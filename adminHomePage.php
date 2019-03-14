<?php
session_start();
include ('connection.php');
/*
if ( !isset( $_SESSION['user'])) {
    header('location: login.php');
    exit();
}*/
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Home Page</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/unsemantic-grid-responsive-tablet.css">
</head>
<body >
<div class="">
<header>
    <h2>Admin</h2>
</header>
<!--<a href="#">London</a>,-->
<section>
    <nav>
        <ul>

            <li> <form method="post" action="adminHomePage.php"><button type="submit" name="add">Add User</button></form></li>
            <li><form method="post" action="adminHomePage.php"><button type="submit" name="update">Update</button></form></li>
            <li><form action="adminHomePage.php" method="post"><button type="submit" name="delete"> Delete</button></form></li>
            <li><form method="post" action="adminHomePage.php"><button name="search" type="submit">search</button></form></li><br><br><br>
            <li><form  style="margin-top: 70% " method="post" action="log-out.php"><button class="exit" type="submit" name="out">sign out</button></form></li>
        </ul>
    </nav>

    <article>

        <?php

        if (isset($_POST['add'])){
            // here the admin can add a new user when click add BUTTON
            print "<form action='adminJobs/add.php' method='post'>
                        <div>
                             <div >
                                 <label>First Name</label>
                                 <input type='text' name='first' placeholder='first name' required>
                             </div>
                             
                             <div >
                             <label>Last Name</label>
                               <input type='text' name='last' placeholder='last name' required>                                
                             </div>
                             
                            <div >
                             <label>Username</label>
                               <input type='text' name='username' placeholder='username' required>                               
                             </div>
                             
                             <div >
                             <label>Email</label>
                               <input type='email' name='email' placeholder='email' required>    
                             </div>
                             
                               <div class='input-box'>
                                <label>Password</label>
                               <input type='password' name='password' placeholder='password' required>  
                             </div>                  
                             
                             <div class='input-box'>
                                <label>Confirm Password</label>
                               <input type='password' name='password_con' placeholder='confirm password' required>                                
                             </div>
                             
                             <div>
                                 <label>Type of User</label>
                                            <select name='user_type'>
                                            <option></option>
                                            <option>Add User</option>
                                            <option>Add Administrator</option>
                                 </select>
                            </div>

                        <button class='input-bt' type='submit' name='add_user'>Add New User</button>
                        <form action=''><button style='background: red' class='input-bt' type='submit' name='close'>Cancel</button></form>
                        </div>
                  </form>";
        }
        ?>

    </article>
</section>
</div>
</body>
</html>