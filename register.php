<?php

include ('connection.php');
//include ('registration.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/unsemantic-grid-responsive-tablet.css">
    <link rel="stylesheet" href="css/style_re.css">

    <title>online storage registration</title>
</head>

<body class="grid-container">
        <div class="grid-100">
            <header class="header1">
                <div class="logo">
                    <img src="#">
                </div>

                <div>
                    <h1>Online Storage</h1>
                </div>


            </header>
        </div>
        <div id="title">
            <h2>Welcome to Online Storage Registration Page</h2>
        </div>
        <main  class="grid-container">
        <!--<div class="grid-95">-->
            <div  class="login-box-re">
                <form   method="post" action="registration.php">
                    <h2>Registration Form</h2>

                    <?php if (isset($_GET['user'])){
                        if ($_GET['user']=="empty"){
                            echo "<div class='error'>you have empty place, Please fill all the form...!</div>";
                        }
                    }?>
                    <?php if (isset($_GET['password'])){
                        if ($_GET['password']=="not_match"){
                        echo "<div class='error'>Password Not Match,try again...!</div>";
                        }
                    }?>
                    <?php if (isset($_GET['first_last'])){
                        if ($_GET['first_last']=="error"){
                            echo "<div class='error'>first/last name not right,must not have number...</div>";
                        }
                    }?>
                    <?php if (isset($_GET['email'])){
                        if ($_GET['email']=="error"){
                            echo "<div class='error'>Wrong email, Please enter the right email</div>";
                        }
                    }?>

                    <?php if (isset($_GET['email_username'])){
                        if ($_GET['email_username']=="taken"){
                            echo "<div class='error'>Sorry username/email was taken try again..!</div>";
                        }
                    }?>
                    <div class="input-box">
                        <input type="text" name="first" placeholder="first name" required>
                        <label>first name</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="last" placeholder="last name" required>
                        <label>last name</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="username" placeholder="username" required>
                        <label>username</label>
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" placeholder="email" required>
                        <label>Email Address</label>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" placeholder="password" required>
                        <label>password</label>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password_con" placeholder="confirm password" required>
                        <label>confirm password </label>
                    </div>
                        <button class="login-box-btn" onclick="document.getElementById('mo').style.display='block'" type="button" name="registerJust">Sign up</button>

                    <p>click <a href="login.php">Here</a> to login if you are already a customer</p>
               <!-- </form>-->

                <!--start of the security questions-->


                <script>
                    // Get the modal
                    var mo = document.getElementById('mo');
                    window.onclick = function(security) {
                        if ( (security.target == mo) ) {
                            mo.style.display = "none";
                        }
                    }
                </script>
        </div>
            <div id="mo"  class="modal" >
                <div class="modal-content animate">
                    <h3>Please the security questions and the answer will saved for security </h3>
                    <span onclick="document.getElementById('mo').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <label for="q1">question 1</label>
                    <select class="justMo" name = "q1">
                        <?php

                        $query = "SELECT * FROM question";
                        $result = mysqli_query($db,$query);
                        while ($rows = $result -> fetch_assoc()) {
                            $qid = $rows['id'];
                            $question = $rows ['questions'];?>
                            <option value = "<?php echo $qid ?>"><?php echo $question; ?> </option>
                        <?php }?>
                    </select>
                    <label for="ans1">Answer 1</label>
                    <input class="justMo" type="text" name="ans1" placeholder="answer">




                    <label for="q2">question 2</label>
                    <select class="justMo" name = "q2">

                        <?php

                        $query = "SELECT * FROM question";
                        $result = mysqli_query($db,$query);
                        while ($rows = $result -> fetch_assoc()) {
                            $qid = $rows['id'];
                            $question = $rows ['questions'];?>
                            <option value = "<?php echo $qid ?>"><?php echo $question; ?> </option>
                        <?php }?>

                    </select>
                    <label for="ans2">Answer 2</label>
                    <input  class="justMo" type="text" name="ans2" placeholder="answer">

                    <button class="button1" type="submit" name="register">Register</button><br><br>
                    <button type="button" onclick="document.getElementById('mo').style.display='none'" class="cancelbtn">Cancel</button>
                </div>
            </div>
            <!--end of the security questions-->
    </main >

</body>
</html>