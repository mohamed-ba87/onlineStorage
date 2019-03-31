<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gallery</title>
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
        <h1 id="colorlib-logo"><a href="index.html"><span class="flaticon-camera"></span><?php
                session_start();
                echo $_SESSION['username'];?></a></h1>
        <nav id="colorlib-main-menu" role="navigation">
            <ul>
                <li><a href="index.html">Profile</a></li>
                <li class="colorlib-active"><a href="galleery.php">Gallery</a></li>

            </ul>
        </nav>
    </aside> <!-- END COLORLIB-ASIDE -->
    <div id="colorlib-main">

        <section class="ftco-section bg-light ftco-bread">
            <!--search bar -->
            <div class="search-container">
                <form action="#" method="post">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><i class="fa fa-search"></i> search</button>
                </form>
            </div>

            <div class="container">
                <div class="row no-gutters slider-text align-items-center">

                    <div class="col-md-9 ftco-animate">
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">profile</a></span> <span>Gallery</span></p>
                        <h1 class="mb-3 bread">Galleries</h1>
                    </div>


        </section>
        <section class="ftco-section-2">
            <div class="photograhy">
                <div class="row no-gutters">
                    <?php
                    include ('connection.php');
                    $username=  $_SESSION['username'];
                    $sql= "SELECT * FROM user_images WHERE username='$username' ORDER BY setImage DESC";
                    // $my= mysqli_query($db,$sql);

                    $tsmt= mysqli_stmt_init($db);

                    if (! mysqli_stmt_prepare($tsmt,$sql)){
                        echo "statement failed!";
                    }else{

                        $mo=mysqli_stmt_execute($tsmt);
                        $result= mysqli_stmt_get_result($tsmt);
                        while ($row= mysqli_fetch_assoc($result)){
                            $imageTit=$row['title']; //<- need to pass the data base name
                            $imgName=$row['imageName'];  //<- need to pass real database name
                            $imgDes=$row['fileDis'];    //<- need to pass real database name
                            //here we will pass java script link
                            ?>
                            <div class="col-md-4 ftco-animate">
                                <a class="photography-entry img image-popup d-flex justify-content-center align-items-center" href="userImages/<?php echo $imgName;?>" style="background-image: url(userImages/<?php echo $imgName;?>);">
                                    <div class="overlay"></div>
                                    <div class="text text-center">
                                        <h3><?php echo $imageTit;?></h3>
                                        <span class="tag"><?php echo $imgDes;?></span>
                                    </div>
                                </a>
                            </div>
                        <?php }
                    }
                    ?>


                </div>

            </div>
        </section>
        <footer class="ftco-footer ftco-bg-dark ftco-section">
            <div class="container px-md-5">


                <div class="all">
                    <form method='post' action='gallery-upload.php' enctype='multipart/form-data'>
                        <input class="inputFile" type="text" name="filename" placeholder="file title"><br><br>
                        <input class="inputFile" type="text" name="title" placeholder="file title"><br><br>
                        <input class="inputFile" type="text" name="fileDis" placeholder="image des"><br><br>
                      <div class="input-container"><input type="file" name="file"></div><br><br>


                        <button type="submit" name="submit">Upload</button>
                    </form>
                </div>


            </div>
        </footer>
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
