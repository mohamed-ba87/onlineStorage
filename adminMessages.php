<?php
session_start();
include ('connection.php');
if ( !isset($_SESSION['username'])) {
    header('location: login.php');
    exit();
}
$username= $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>create message</title>
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



</head>
<body>

<div id="colorlib-page">
    <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
    <aside id="colorlib-aside" role="complementary" class="js-fullheight text-center">
        <h3 id="colorlib-logo"><a href="adminHomePage.php">Online Storage<span></span>  <?php
                echo $_SESSION['username'];?></a></h3>

    </aside> <!-- END COLORLIB-ASIDE -->
    <div id="colorlib-main">
        <section class="ftco-section bg-light ftco-bread">


            <div class="container">
                <div class="row no-gutters slider-text align-items-center">
                    <div class="col-md-9 ftco-animate">
                        <h1 class="mb-3 bread">Here You Can Send Messages</h1>
                        <p class="mb-3 bread">Here you can send messages </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="ftco-section contact-section">

            <div class="row block-9">
                <div class="col-md-6 order-md-last d-flex">
                    <?php
                    if (isset($_GET['mess'])){

                    if ($_GET['mess']=="empty"){?>

                        <script> alert("<?php echo 'sorry you must fill all the fields and the image is optional...!';?>")</script>
                    <?php }

                    if ($_GET['mess']=="no"){?>

                        <script> alert("<?php echo 'Sorry this user not exist yet...';?>")</script>
                    <?php }

                    if ($_GET['mess']=="big"){?>

                        <script> alert("<?php echo 'Sorry the file you uploaded too big...';?>")</script>
                    <?php }

                    if ($_GET['mess']=="imError"){?>

                        <script> alert("<?php echo 'there was uploading error...';?>")</script>
                    <?php }


                    }

                    ?>
                    <form action="adminSendMessage.php" method="post" class="bg-light p-5 contact-form" >
                        <div class="form-group">
                            <label for="user_name">Username</label>
                            <input type="text" class="form-control" name="user_name" placeholder="Username/email">
                        </div>
                        <div class="form-group">
                            <label for="title">Subject</label>
                            <input type="text" class="form-control" name="title" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <label for="message"></label>
                            <textarea name="message" cols="30" rows="7" class="form-control" placeholder="Please Write Your Message Here...."></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="sub_message_admin" value="<?php echo $username;?>" class="btn btn-primary py-3 px-5">Send</button>
                            <!-- <input type="submit" name="sub_message" value="" class="btn btn-primary py-3 px-5">-->
                        </div>
                    </form>

                </div>
            </div>
        </section>


    </div><!-- END COLORLIB-MAIN -->
</div><!-- END COLORLIB-PAGE -->

<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


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
