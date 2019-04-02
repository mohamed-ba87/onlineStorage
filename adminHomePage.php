<?php
session_start();
include ('connection.php');
/*
if ( !isset(  $_SESSION['username'])) {
    header('location: login.php');
    exit();
}else{
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
                    header('location : login.php?login=success');
                    exit();

                }
            }
        }
}*/
if (isset($_POST['upload'])){
    $username=$_SESSION['username'];


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

$sqlLog = "SELECT * FROM login WHERE username = '$username' ";
$resultLog = $db->query($sqlLog);

while ($row = $resultLog->fetch_assoc()) {
    $_SESSION['pic']= $row['photo'];

}
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Hom Page</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/unsemantic-grid-responsive-tablet.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body >
<div class="">
<header>
    <center>
        <?php
        if (empty($_SESSION['pic'])){ ?>
            <img class="profile_img"  src="profileImage/admin_profile.png" onclick="document.getElementById('id01').style.display='block'">
        <?php }else{
            $image = "profileImage/".$_SESSION['pic'];
            ?>
            <img class="profile_img" alt="upload pic" src="<?php echo $image;?>" onclick="document.getElementById('id01').style.display='block'">
       <?php } ?>

        <center>
    <h3>Admin</h3>
</header>

   <!--
 <div id="profile_img1" class="profile_image">
        <input type="file" name ="file">
    <button name="upload" type="submit"></button>
     <button onclick="document.getElementById('profile_img1').style.display='none'">Cancel</button>
 </div>
    -->
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

    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <section>
    <nav>
        <ul>

            <li> <form method="post" action="adminHomePage.php"><button type="submit" name="add">Add User</button></form></li>
            <li><form method="post" action="adminHomePage.php"><button type="submit" name="update">Update</button></form></li>
            <li><form action="adminHomePage.php" method="post"><button type="submit" name="delete"> Delete</button></form></li>
            <li><form method="post" action="adminHomePage.php"><button name="search" type="submit">search</button></form></li><br><br><br>
            <li><form  style="margin-top: 250px " method="post" action="log-out.php"><button class="exit" type="submit" name="out">sign out</button></form></li>
        </ul>
    </nav>

    <article>
        <?php
        if (isset($_POST['add'])){   // here the admin can add a new user when click add BUTTON?>

            <form action='adminJobs/add.php' method='post'>
                <div>
                    <div >
                        <label>First Name</label>
                        <input id='first' type='text' name='first' placeholder='first name' required>
                    </div>

                    <div >
                        <label>Last Name</label>
                        <input id='last' type='text' name='last' placeholder='last name' required>
                    </div>

                    <div >
                        <label>Username</label>
                        <input type='text' id='user' name='username' placeholder='username' required>
                    </div>

                    <div >
                        <label>Email</label>
                        <input id='email' type='email' name='email' placeholder='email' >
                    </div>

                    <div class='input-box'>
                        <label>Password</label>
                        <input id='pass1' type='password' name='password' placeholder='password' >
                    </div>

                    <div class='input-box'>
                        <label>Confirm Password</label>
                        <input id='pass2' type='password' name='password_con' placeholder='confirm password' >
                    </div>

                    <div>
                        <label>Type of User</label>
                        <select name='user_type'>
                            <option></option>
                            <option>Add User</option>
                            <option>Add Administrator</option>
                        </select>
                    </div>

                    <button class='input-bt' id='add_u' type='submit' name='add_user'>Add New User</button>

                </div>
            </form>

            <!--started here




            end here-->
            <form onsubmit="return confirm('Are Sure you?')"  action='adminJobs/close.php' method='post'>
                <div>
                    <button style='background: red' class='input-bt' type='submit'  name='close'>Cancel</button>
                </div>
            </form>

<?php
        }
        // delete form for the admin delete a usr from the database
        if (isset($_POST['delete'])){?>

            <form action='adminJobs/delete.php' method='post'>
                <div class='input-box'>
                    <label>Username/email</label>
                    <input type='text' name='de' placeholder='username/email that want to delete' required>

                </div>
                <button onclick='del()' type='submit' id='delete' name='delete' class='input-bt' >Delete</button>
                <script>
                    function del() {
                        return alert('user been deleted');
                    }
                </script>
                <!-- // closing button or cancel-->
            </form>

            <form onsubmit="return confirm('Are Sure you?')"  action='adminJobs/close.php' method='post'>
                <div>
                    <button style='background: red' class='input-bt' type='submit' name='close'>Cancel</button>
                </div>

            </form>

          <?php
        }

        ?>

    </article>
</section>
</div>
</body>
</html>