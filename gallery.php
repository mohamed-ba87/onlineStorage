


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My PortFolio</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
</head>
<body>

<header>
    <a href="" class="">mmtuts</a>
    <nav>
        <ul>
            <li><a href="">Portfolio</a></li>
            <li><a href="">About me</a></li>
            <li><a href="">content</a></li>
        </ul>
        <a href="">Cases</a>
    </nav>
</header>
<main>
    <section class="gallery-links">
        <div class="wrapper">
            <h2>gallery</h2>
<!--style="background-image:url("we need to give the path",'.$row['imageName'].'); "-->
            <div class="gallery-container">
                <a href="">
                    <div ></div>
            <h3>elhadi </h3>
            <p>mohamed</p>
            </a>
                <div class="gallery-container">
                    <a href="">
                        <div ></div>
                        <h3>elhadi </h3>
                        <p>mohamed</p>
                    </a>
        <!--here will be the java script link-->   <?php
                include ('connection.php');
                $sql= "SELECT * FROM nameOftable ORDER BY oredergallery DESC";
                $tsmt= mysqli_stmt_init($db);
                if (! mysqli_stmt_prepare($tsmt,$sql)){
                    echo "statement failed!";
                }else{
                    mysqli_stmt_execute($tsmt);
                    $result= mysqli_stmt_get_result($tsmt);

                    while ($row= mysqli_fetch_assoc($result)){
                        $imageTit=$row['imageTitle']; //<- need to pass the data base name
                        $imgName=$row['imageName'];  //<- need to pass real database name
                        $imgDes=$row['imageDes'];    //<- need to pass real database name
                        //here we will pass java script link
                      echo" <a href=''>  
                            <div style='background-image:url('we need to give the path',.'$imgName'.); '></div>
                            <h3>'.$imageTit.'</h3>
                            <p>'.$imgDes.'</p>
                          </a>";

                    }
                }
                ?>

            </div>
            <?php
            if(isset($_SESSION['username'])){

            echo "<div class='gallery-upload'>
                <form method='post' action='gallery-upload.php' enctype='multipart/form-data'>
                    <input type='text' name='filename' placeholder='file name'>
                    <input type='text' name='title' placeholder='file title'>
                    <input type='text' name='fileDis' placeholder='image des'>
                    <input type='text' name='file'>
                    <button type='submit' name='submit'>Upload</button>
                </form>
            </div>";
        }
        ?>


        </div>
    </section>
</main>
</body>
</html>