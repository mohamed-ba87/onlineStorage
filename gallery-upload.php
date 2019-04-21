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
               header('location : gallery.php?upload=empty');
               exit();
           }else{
               $select= "SELECT * FROM user_images WHERE username = '$username'";
               $ck=mysqli_query($db,$select);
                 $rowsNum= mysqli_num_rows($ck);
             //  $_SESSION['size']= $rowsNum;
                 if ($rowsNum <=20){
                 $setImage= $rowsNum+1;
                 $_SESSION['size']= $rowsNum;
            //   print_r($rowsNum);
             //  exit();
                 $sql= "INSERT INTO user_images (username,title,fileDis,imageName,setImage) VALUES ('$username' ,'$title' , '$fileDis' , '$imageName' , '$setImage')";
               $result=  mysqli_query($db,$sql);

                     move_uploaded_file($fileTmpName,$fileDestination);
               ?>

      <?php
                     header('location : gallery.php?upload=success');
                     exit();
                 }else{
                     header('location : gallery.php?upload=full');
                     exit();
                 }

           }

       }else{
           header('location : gallery.php?upload=big');
           exit();

       }
   }else{
       header('location : gallery.php?upload=error');
       exit();
   }
}
