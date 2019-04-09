<?php
session_start();
include ('connection.php');

if ( !isset(  $_SESSION['username'])) {
    header('location: login.php');
    exit();
}/*
else{
        $username=$_SESSION['username'];
        $sql= "SELECT * FROM login WHERE username='$username' OR email= '$username'";
        $result = mysqli_query($db,$sql);
        $check= mysqli_num_rows($result);

        if ($check !=1){
            header('location: login.php?login=wrong_sql_NotThere');
            exit();
        }else {

            if ($row = mysqli_fetch_assoc($result)) {
                $type = $row['types'];
                if ($row['types'] == 1) {
                    header('location : adminHomePage.php?login=success');
                    exit();
                }
            } else {

                if ($row['types'] == 0) {
                    header('location : userProfile.php?login=success');
                    exit();

                }
            }
        }
}*/
$username=$_SESSION['username'];

if (isset($_POST['upload'])){

 //   $username=$_SESSION['username'];

    $targetDir="C:/inetpub/wwwroot/1808234/onlineStore/profileImage/";
    $fileName = basename($_FILES['file']['name']);
    $fileTmpName = $_FILES['file']['tmp_name'];
    $folder = $targetDir.$fileName;
    move_uploaded_file($fileTmpName, $folder);
    $photosql= "UPDATE login SET photo='$fileName' WHERE username='$username'";

    $result = mysqli_query($db,$photosql);

    header('location : tradeProfile.php?upload=success');
    exit();
}

$sqlLog = "SELECT * FROM login WHERE  username = '$username' ";
$resultLog = $db->query($sqlLog);

while ($row = $resultLog->fetch_assoc()) {
    $_SESSION['pic']= $row['photo'];
}

$sql = "SELECT * FROM user_info WHERE  username = '$username' ";
$result = $db->query($sql);

while ($rows = $result->fetch_assoc()) {
    $_SESSION['na'] = $rows['first_name'];
    $_SESSION['na1'] = $rows['last_name'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Home Page</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/unsemantic-grid-responsive-tablet.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body >

<header>
    <h2 style="float: right; margin-right: 20px; margin-top: 60px">Online Storage</h2>

    <h2 style="float: left; margin-left: 20px; margin-top: 60px">Welcome:<br><?php echo $_SESSION['username'];?></h2>
    <center>   <!-- displaying profile image start here-->
        <?php
        if (empty($_SESSION['pic'])){ ?>
            <img class="profile_img"  src="profileImage/admin_profile.png" onclick="document.getElementById('id01').style.display='block'">
        <?php }else{
            $image = "profileImage/".$_SESSION['pic'];
            ?>
            <img class="profile_img" alt="upload pic" src="<?php echo $image;?>" onclick="document.getElementById('id01').style.display='block'">
       <?php } ?>
        <center>    <!-- displaying profile image end here-->

    <h3 style="">Admin:<?php echo " ".$_SESSION['na']." ". $_SESSION['na1'] ?></h3>

</header>

<!-- profile image upload and display start here-->
<div id="id01" class="modal">

    <form class="modal-content animate" action="adminHomePage.php" method="post" enctype="multipart/form-data">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

        </div>

        <div class="container">
            <input type="file" name ="file">
            <button name="upload" type="submit">Upload</button>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
    </form>
</div>
<!-- profile image upload and display end here-->


<section>

    <nav>
        <ul>

            <li> <button onclick="document.getElementById('add').style.display='block'" type="button" name="add">Add User</button></li>
            <li><form method="post" action="adminHomePage.php"><button type="submit" name="update">Update</button></form></li>
            <li><button onclick="document.getElementById('delete').style.display='block'" type="button" name="delete">Delete</button></li>
            <li><button onclick="document.getElementById('search').style.display='block'"  name="search" type="button">search</button></li><br><br><br>
            <li><form onsubmit="return confirm('Are you sure do you want to LOG OUT...?')" style="margin-top: 250px " method="post" action="log-out.php"><button class="exit" type="submit" name="out">sign out</button></form></li>
        </ul>
    </nav>

    <article>
        <?php if (isset($_GET['login'])){
            if ($_GET['login']=="success"){
                echo "<div class='success'>
                            <h3>Welcome Back</h3><br>
                            <p>You have logged in successfully</p>
                    </div><?php";
            }
        }?>
        <!-- add new user start here-->
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

        <div id="add" class="modal">
            <form class="modal-content animate"   action="adminJobs/add.php" onsubmit="return confirm('Are Sure you want to add this user?')" method="post">
                <span onclick="document.getElementById('add').style.display='none'" class="close" title="Close Modal">&times;</span>
                <div>
                    <div >
                        <label for="first">First Name</label>
                        <input id="first" type="text" name="first" placeholder="first name" required>
                    </div>

                    <div >
                        <label for="last">Last Name</label>
                        <input id="last" type="text" name="last" placeholder="last name" required>
                    </div>

                    <div >
                        <label for="username">Username</label>
                        <input type="text" id="user" name="username" placeholder="username" required>
                    </div>

                    <div >
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" placeholder="email" >
                    </div>

                    <div class="input-box">
                        <label for="password">Password</label>
                        <input id="pass1" type="password" name="password" placeholder="password">
                    </div>

                    <div class="input-box">
                        <label for="password_con">Confirm Password</label>
                        <input id="pass2" type="password" name="password_con" placeholder="confirm password" >
                    </div>

                    <div>
                        <label for="user_type">Type of User</label>
                        <select name='user_type' >
                            <option></option>
                            <option>Add User</option>
                            <option>Add Administrator</option>
                        </select>
                    </div>

                    <button class="input-bt" id="add_u" type="submit" name="add_user">Add New User</button>
                    <button type="button" onclick="document.getElementById('add').style.display='none'" class="cancelbtn">Cancel</button>

                </div>

            </form>
        </div>
        <!-- add new user end here-->


        <!-- delete user start here-->
        <?php if (isset($_GET['user'])){
            if ($_GET['user']=="not_existed"){
                echo "<div class='error'>user not in our record...!</div>";
            }
        }?>
        <?php if (isset($_GET['delete'])){
            if ($_GET['delete']=="com"){?>
        <div class="error">
            <?php echo "user was deleted";?>
        </div>
            <?php}
        }?>
        <div id="delete" class="modal">
            <div>
                <form class="modal-content animate"  action="adminJobs/delete.php" onsubmit="return confirm('Are Sure you?')"  method="post">
                    <span onclick="document.getElementById('delete').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <div class="input-box">
                        <label>Username/email</label>
                        <input type="text" name="de" placeholder="username/email that want to delete" required>
                    </div>
                    <button type="submit"  name="delete" class="input-bt">Delete</button>
                    <button type="button" onclick="document.getElementById('delete').style.display='none'" class="cancelbtn">Cancel</button>
                </form>
            </div>
        </div>
        <!-- delete user end here-->



        <!-- search for a user start here-->
        <div id="search" class="modal">
            <div class="search-container">
                <form action="search.php" method="post" class="modal-content animate" >
                    <p>Please enter the username or email...!
                        <span onclick="document.getElementById('search').style.display='none'" class="close" title="Close Modal">&times;</span>
                        <input type="text" placeholder="Search....." name="search"></p><br><br><br>
                    <button class="input-bt" type="submit" name="btn_search"><i class="fa fa-search"></i>Search</button>
                    <button type="button" onclick="document.getElementById('search').style.display='none'" class="cancelbtn">Cancel</button>
                </form>
            </div>
        </div>
      <?php
      if (isset($_GET['search'])) {
          if ($_GET['search']=="nothing") {
              echo "Result not found..!";
              exit();
          } else {
              echo $_SESSION['result'] . "<br>.<br>";
              ?>
              <h3>Username: <br><?php echo $_SESSION['uname']; ?></h3><br><br>
              <h3>Email:<br><?php echo $_SESSION['em']; ?></h3><br><br>
              <h3>first name: <br><?php echo $_SESSION['first']; ?></h3><br><br>
              <h3>Last name: <br><?php echo $_SESSION['last']; ?></h3><br><br>

              <?php
          }
      }?>
        <!-- search for a user end here with php code-->


    </article>
</section>
</body>
</html>