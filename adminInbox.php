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
    <title>Inbox</title>
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
        <div class="colorlib-footer">

        </div>
    </aside> <!-- END COLORLIB-ASIDE -->
    <div id="colorlib-main">
        <section class="ftco-section bg-light ftco-bread">
            <div class="container">
                <div class="row no-gutters slider-text align-items-center">
                    <div class="col-md-9 ftco-animate">
                        <h1 class="mb-3 bread">Here You Can Find All Your Messages</h1><br>
                        <div >
                            <form action="adminHomePage.php" method="post" >
                                <button type="submit" name="back" style="  background: transparent;
    border: none;
    outline: none;
    color: #fff;
    background: darkmagenta;
    padding: 10px 20px;
    cursor: pointer;
    border-radius:5px ;
    text-align: center;"> <-- Click Here Back To your Main Page</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="blog-entry ftco-animate">
                                    <?php


                                    $sqlOut = "SELECT * FROM messages,user_mail_box WHERE 
                                                messages.message_id = user_mail_box.message_id 
                                                AND user_mail_box.mail_box='in' AND user_mail_box.username= '$username ' ORDER BY messages.times DESC";
                                    $qu= mysqli_query($db,$sqlOut);
                                    if (mysqli_num_rows($qu) == 0 ){
                                        echo "your inbox is currently empty";
                                    }else{
                                        while ($rows= mysqli_fetch_assoc($qu)){
                                            $imgName=$rows['photo'];
                                            $title=$rows['title'];
                                            $message=$rows['message'];
                                            $sender=$rows['from_user'];
                                            $time=$rows['times'];

                                            ?>
                                            <div class="text text-2 pt-2 mt-3">
                                                <h3 class="mb-2">Title:<?php echo " ".$title;?></h3>
                                                <h3>From :<?php echo " ".$sender;?></h3>
                                                <div class="meta-wrap">
                                                    <p class="meta">
                                                        <span>Time: <?php echo " ".$time;?></span>
                                                    </p>
                                                </div>
                                                <p class="mb-4">Message:<br><?php echo $message;?></p>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>

                    </div>
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
<!--//style=""-->