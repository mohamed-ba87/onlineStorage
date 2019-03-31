


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/gallery.css">
    <link rel="stylesheet" href="css/unsemantic-grid-responsive-tablet.css">
    <title>My PortFolio</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="Demo for the tutorial: Styling and Customizing File Inputs the Smart Way" />
    <meta name="keywords" content="cutom file input, styling, label, cross-browser, accessible, input type file" />
    <meta name="author" content="Osvaldas Valutis for Codrops" />
    <!-- javascript links-->
    <script src="js/custom-file-input.js"></script>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>

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
                            <div style='background-image:url('C:/inetpub/wwwroot/1808234/CMM004-NewProject-master/CMM004-NewProject-master/img/'.'$imgName'.); '></div>
                            <h3>'.$imageTit.'</h3>
                            <p>'.$imgDes.'</p>
                          </a>";

                    }
                }
                ?>

            </div>
            <?php
            ?>

            <div class="all">
                <form method='post' action='gallery-upload.php' enctype='multipart/form-data'>
                    <input type='text' name='filename' placeholder='file name'>
                    <input type='text' name='title' placeholder='file title'>
                    <input type='text' name='fileDis' placeholder='image des'>

                    <div class="container">
                        <div class="content">
                            <div class="box">
                                <input type="file" name="file-7[]" id="file-7" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple />
                                <label for="file-7"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17"  viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> Choose a file&hellip;</strong></label>
                            </div>
                        </div>
                    <button type='submit' name='submit'>Upload</button>
                </form>
            </div>
                <?php
                if(isset($_SESSION['username'])){  }
        ?>


        </div>
    </section>
</main>
</body>
</html>