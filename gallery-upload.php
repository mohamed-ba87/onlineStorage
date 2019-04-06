<?php
session_start();
include ('connection.php');

if (isset($_POST['submit'])){
    $username= $_SESSION['username'];
    $newFile= $_POST['filename'];

    if ( empty($newFile)){
        $newFile="gallery";
    }else{

        $newFile= strtolower(str_replace(" ","-",$newFile));

    }
    $title= mysqli_real_escape_string($db,$_POST['title']);
    $fileDis= mysqli_real_escape_string($db,$_POST['fileDis']);

    $file=$_FILES['file'];
    $filename=$file['name'];
    $fileTmpName=$file['tmp_name'];
    $fileError=$file['error'];
    $fileSize=$file['size'];

   $fileExt= explode(".", $filename);

   $fileActExt= strtolower(end($fileExt));


   if ($fileError===0){

       if ($fileSize<250000){
           $imageName= $newFile . ".".uniqid("",true).".".$fileActExt;

           $fileDestination="C:/inetpub/wwwroot/1808234/onlineStore/userImages/". $imageName;

           if (empty($title) || empty($fileDis)){
               header('location gallery.php?upload=empty');
               exit();
           }else{
               $select= "SELECT * FROM user_images";
               $ck=mysqli_query($db,$select);
                 $rowsNum= mysqli_num_rows($ck);
                 $setImage= $rowsNum+1;
                 $sql= "INSERT INTO user_images (username,title,fileDis,imageName,setImage) VALUES ('$username' ,'$title' , '$fileDis' , '$imageName' , '$setImage')";
               $result=  mysqli_query($db,$sql);

                     move_uploaded_file($fileTmpName,$fileDestination);
               ?>
                     <script>window.alert("the file was successfully uploaded")</script>
      <?php
                     header('location : gallery.php?upload=success');


             //  <script>window.alert("the file was successfully uploaded")</script>


           }

       }else{
           echo "the image size is too big!";
       }
   }else{
       echo "you had an error!";



   }
}
