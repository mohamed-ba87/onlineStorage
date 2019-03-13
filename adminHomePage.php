<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Home Page</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/unsemantic-grid-responsive-tablet.css">
</head>
<body class="grid-container">
<div class="">
<header>
    <h2>Admins</h2>
</header>
<!--<a href="#">London</a>,-->
<section>
    <nav>
        <ul>

            <li> <form method="post" action="adminHomePage.php"><button type="submit" name="add">Add User</button></form></li>
            <li><form method="post" action="adminHomePage.php"><button type="submit" name="update">Update</button></form></li>
            <li><form action="adminHomePage.php" method="post"><button type="submit" name="delete"> Delete</button></form></li>
            <li><form method="post" action="adminHomePage.php"><button name="search" type="submit">search</button></form></li>
            <li><form method="post" action="log-out.php"><button class="exit" type="submit" name="out">sign out</button></form></li>
        </ul>
    </nav>

    <article>

        <?php
        session_start();
        include ('connection.php');
        if (isset($_POST['add'])){
            // here the admin can add a new user when click add BUTTON
            print "<form action='adminJobs/add.php' method='post'>
                        <div>
                             <div class='input-box'>
                                 <label>first name</label>
                                 <input type='text' name='first' placeholder='first name' required>
                             </div>
                             <div class='input-box'>
                               <input type='text' name='last' placeholder='last name' required>
                                <label>last name</label>
                             </div>
                            <div class='input-box'>
                               <input type='text' name='username' placeholder='username' required>
                                <label>username</label>
                             </div>
                             <div class='input-box'>
                               <input type='email' name='email' placeholder='email' required>
                                <label>email</label>
                             </div>
                               <div class='input-box'>
                               <input type='password' name='password' placeholder='password' required>
                                <label>password</label>
                             </div>                  
                             <div class='input-box'>
                               <input type='password' name='password_con' placeholder='confirm password' required>
                                <label>confirm password</label>
                             </div>

                        <button class='login-box-btn' type='submit' name='add_user'>add new user</button>
                        </div>
                  </form>";
        }

        ?>

    </article>
</section>
</div>
</body>
</html>