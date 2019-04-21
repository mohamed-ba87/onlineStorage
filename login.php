<?php  session_start();
include ('connection.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/unsemantic-grid-responsive-tablet.css">

    <link rel="stylesheet" href="css/CSS/capture/css/flaticon.css">
    <link rel="stylesheet" href="css/CSS/capture/css/icomoon.css">
    <title>login</title>
</head>
<body>

<main class="grid-container">
    <div class="grid-100">
        <header class="header1">
            <div class="logo">
                <h1 id="colorlib-logo"><span class="flaticon-camera"></span>
                    Online Storage</h1>
            </div>
        </header>
    </div>
    <div id="title">
        <h2>Welcome to Online Storage login Page</h2>
    </div>

    <div class="grid-95">
        <div class="login-box">
            <form class="" method="post" action="loginsys.php">
                <h2>Login</h2>
                <?php
                if (isset($_GET['registration'])){
                    if ($_GET['registration']=="success"){?>
                        <div class="success">
                            <?php echo "you registration was success"."<br><br>"."Please us your login details to login... ";?>
                        </div>
                <?php }
                }
                ?>

                <?php if (isset($_GET['login'])){
                    if ($_GET['login']=="wrong_empty"){
                        echo "<div class='error'>Sorry username or password was empty,Please try again..!</div>";
                    }
                }?>
                <?php if (isset($_GET['login'])){
                    if ($_GET['login']=="wrong_s"){
                        echo "<div class='error'>Sorry username/email not right...!</div>";
                    }
                }?>

                <?php if (isset($_GET['login'])){
                    if ($_GET['login']=="pwrong"){
                        echo "<div class='error'>Was wrong Password, Please try again...!</div>";
                    }
                }?>
                <div class="input-box">
                    <input type="text" name="username" required>
                    <label>username/email</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password"  required>
                    <label>Password</label>
                </div>
                <?php
                if (isset($_GET['new+pwd'])){
                    if ($_GET['new+pwd']=="passwordUpdated"){
                        echo "<p>your password been updated</p>";
                    }
                }
                ?>
                <a class="a" href="forget_password/restPasswordPage.php">forget Password?</a>
                <br>
                <div >
                    <button class="login-box-btn" type="submit" name="login">Login</button>
                    <p>click <a href="register.php">Here</a> to Register</p>
                </div>

            </form>
        </div>

    </div>
</main>

</body>
</html>