
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
                    header('location : userProfile.php?login=success');
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

if (isset($_POST['profileUpload'])){
    $username=$_SESSION['username'];


    $targetDir="C:/inetpub/wwwroot/1808234/onlineStore/profileImage/";
    $fileName = basename($_FILES['profileImg']['name']);
    $fileTmpName = $_FILES['profileImg']['tmp_name'];
    $folder = $targetDir.$fileName;
    move_uploaded_file($fileTmpName, $folder);
    $photosql= "UPDATE login SET photo='$fileName' WHERE username='$username'";

    $result = mysqli_query($db,$photosql);


}
$username=$_SESSION['username'];
    $sqlLog = "SELECT * FROM login WHERE username = '$username' ";
    $resultLog = $db->query($sqlLog);

    while ($row = $resultLog->fetch_assoc()) {
        $_SESSION['pic']= $row['photo'];

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">

    <link rel="stylesheet" href="css/CSS/capture/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/CSS/capture/css/animate.css">

    <link rel="stylesheet" href="css/CSS/capture/css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/CSS/capture/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/CSS/capture/css/magnific-popup.css">

    <link rel="stylesheet" href="css/CSS/capture/css/aos.css">

    <link rel="stylesheet" href="css/CSS/capture/css/ionicons.min.css">

    <link rel="stylesheet" href="css/CSS/capture/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/CSS/capture/css/jquery.timepicker.css">


    <link rel="stylesheet" href="css/CSS/capture/css/flaticon.css">
    <link rel="stylesheet" href="css/CSS/capture/css/icomoon.css">
    <link rel="stylesheet" href="css/CSS/capture/css/style.css">


    <link rel="stylesheet" href="css/gallery.css">
    <!-- this my staff just added-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.custom-file-input input[type="file"]').change(function(e){
                $(this).siblings('input[type="text"]').val(e.target.files[0].name);
            });
        });
    </script>
    <link rel="stylesheet" href="css/gallery.css">
    <!--this the end of the staff just added-->

</head>
<body>

<div id="colorlib-page">

    <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>

    <aside id="colorlib-aside" role="complementary" class="js-fullheight text-center">
        <h1 id="colorlib-logo"><a href="userProfile.php"><span class="flaticon-camera"></span>
                <?php
                echo $_SESSION['username'];?></a></h1>
        <nav id="colorlib-main-menu" role="navigation">
            <ul>
                <li class="colorlib-active"><a href="userProfile.php">Profile</a></li>
                <li ><a href="gallery.php">Gallery</a></li>

            </ul>
        </nav>


    </aside> <!-- END COLORLIB-ASIDE -->
    <div id="colorlib-main">

        <section class="ftco-section bg-light ftco-bread">
            <!--search bar -->
            <div class="search-container">
                <form action="#" method="post">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit" name="btn_search"><i class="fa fa-search"></i> search</button>
                </form>
            </div>

            <br><br><br><br>
            <!--start for the login out button -->
            <div class="logout">
                <form action="log-out.php" method="post" onclick="return confirm('Are sure you want to LOG OUT?')">
                    <button type="submit" name="logout">Log out</button>
                </form>
            </div>
            <!--end for the login out button -->


            <div class="container">
                <div class="row no-gutters slider-text align-items-center">

                    <div class="col-md-9 ftco-animate">
                        <p class="breadcrumbs"><span class="mr-2"><a href="userProfile.php">profile</a></span> <span><a href="userProfile.php">gallery</a></span></p>
                        <h1 class="mb-3 bread"><?php
                            echo  $_SESSION['username']." ";
                            ?> Profile</h1>
                    </div>


        </section>

        <div class="card">

        </div>

        <section class="ftco-section-2" style="margin-left: 100px; margin-top: 50px">

            <!--start of upload profile image-->
            <div id="id2" class="modal">
                <form class="modal-content animate" method="post" action="userProfile.php" enctype="multipart/form-data">

                        <span onclick="document.getElementById('id2').style.display='none'" class="close" title="Close Modal">&times;</span>

                    <div class="modal-content">
                        <input type="file" name ="profileImg">
                    </div>
                    <button class="button1" name="profileUpload" type="submit">Upload</button><br><br><br><br>
                        <button type="button" onclick="document.getElementById('id2').style.display='none'" class="cancelbtn">Cancel</button><br><br>

                </form>
            </div>

            <script>
                // Get the modal
                var modal = document.getElementById('id2');
                var up = document.getElementById('update');

                window.onclick = function(just) {
                    if (  (just.target == modal) || (just.target == up)) {
                        modal.style.display = "none";
                        up.style.display = "none";

                    }
                }
            </script>
            <!--end of upload profile image-->
            <?php
            if (empty($_SESSION['pic'])){ ?>
                <img style="width: 200px; height: 200px; cursor: pointer" alt="dif pic" class="profile_img"  src="profileImage/admin_profile.png" onclick="document.getElementById('id2').style.display='block'">
            <?php }else{
                $image = "profileImage/".$_SESSION['pic'];
                ?>
                <img style="width: 200px; height: 200px;cursor: pointer" alt="dif pic" class="profile_img"  src="<?php echo $image;?>" onclick="document.getElementById('id2').style.display='block'">
            <?php } ?>

            <?php

            if (isset($_POST['update'])){

                $username = $_SESSION['username'];
                $first=mysqli_real_escape_string($db,$_POST['first']);
                $last=mysqli_real_escape_string($db,$_POST['last']);
                $uname=mysqli_real_escape_string($db,$_POST['username']);
                $email=mysqli_real_escape_string($db,$_POST['email']);

                if (! empty($first) ||! empty($last) || ! empty($uname) || ! empty($email)){
                    $user= "UPDATE login SET username='$uname', email= '$email' WHERE username= '$username' ";
                   // $users= mysqli_query($db,$user);
                    $user1= "UPDATE user_info SET first_name='$first',last_name='$last' WHERE username='$username'";
                    $users1= mysqli_query($db,$user1);
                    $users= mysqli_query($db,$user);
                   /// header('location : mainpage.php?updateUsername=success');
                    exit();
                }else{
                    header('tradeProfile.php?error==username');
                    exit();
                }
            }

            ?>



            <div id="update" class="modal">
                <form class="modal-content animate" method="post" action="userProfile.php" >
                        <span onclick="document.getElementById('update').style.display='none'" class="close" title="Close Modal">&times;</span>
<div class="modal-content">
                        <label for="first"><b>first name</b></label>
                        <input class="justMo" type="text" placeholder="First Name" name="first">
                        <label for="last"><b>last name</b></label>
                        <input class="justMo" type="text" placeholder="Last Name" name="last">

                        <label  for="username"><b>username</b></label>
                        <input class="justMo" type="text" placeholder="username" name="username">

                        <label  for="email"><b>Email</b></label>
                        <input class="justMo" type="text" placeholder="Email" name="email"><br><br>

    <button class="button1" type="submit" name="update">update</button><br><br>

                        <button type="button" onclick="document.getElementById('update').style.display='none'" class="cancelbtn">Cancel</button><br><br>
</div>
                </form>
            </div>



            <h3>first name: <br><?php echo  $_SESSION['first']; ?></h3>
            <h3>Last name : <br><?php echo   $_SESSION['last']; ?></h3>
            <h3>Username : <br><?php echo  $_SESSION['username']; ?></h3>
            <h3 class="title">Email : <br><?php echo $_SESSION['email'];?></h3>
            <button class="button1" onclick="document.getElementById('update').style.display='block'" style="width:auto; float: left;">update</button>
        </section>

    </div><!-- END COLORLIB-MAIN -->
</div><!-- END COLORLIB-PAGE -->

<!-- loader -->
<script src="css/CSS/capture/js/jquery.min.js"></script>
<script src="css/CSS/capture/js/jquery-migrate-3.0.1.min.js"></script>
<script src="css/CSS/capture/js/popper.min.js"></script>
<script src="css/CSS/capture/js/bootstrap.min.js"></script>
<script src="css/CSS/capture/js/jquery.easing.1.3.js"></script>
<script src="css/CSS/capture/js/jquery.waypoints.min.js"></script>
<script src="css/CSS/capture/js/jquery.stellar.min.js"></script>
<script src="css/CSS/capture/js/owl.carousel.min.js"></script>
<script src="css/CSS/capture/js/jquery.magnific-popup.min.js"></script>
<script src="css/CSS/capture/js/aos.js"></script>
<script src="css/CSS/capture/js/jquery.animateNumber.min.js"></script>
<script src="css/CSS/capture/js/bootstrap-datepicker.js"></script>
<script src="css/CSS/capture/js/jquery.timepicker.min.js"></script>
<script src="css/CSS/capture/js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="css/CSS/capture/js/google-map.js"></script>
<script src="css/CSS/capture/js/main.js"></script>

</body>
</html>









