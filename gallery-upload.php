<?php
session_start();
include ('connection.php');

if (isset($_POST['submit'])){
    $newFile= mysqli_real_escape_string($db,$_POST['filename']);
    if ( empty($newFile)){
        $newFile="gallery";
    }else{
        $newFile= strtolower(str_replace(" ","-",$newFile));
    }
    $title= mysqli_real_escape_string($db,$_POST['title']);
    $fileDis= mysqli_real_escape_string($db,$_POST['fileDis']);

    $file=$_FILES['file'];

    $filename=$file['name'];
    $fileTmpName=$file['tmp-name'];
    $fileError=$file['error'];
    $fileSize=$file['size'];

   $fileExt= explode(".", $filename);
   $fileActExt= strtolower(end($fileExt));

   if ($fileError===0){
       if ($fileSize<350000){
           $imageName= $newFile . ".".uniqid("",true).".".$fileActExt;
           $fileDestination="../file name". $fileActExt;
           //
           if (empty($title) || empty($fileDis)){
               header('location : ../gallery.php?upload=empty');
               exit();
           }else{
               $select= "SELECT * FROM nameOfthetable";
               $ck=mysqli_stmt_init($db);
             if (! mysqli_stmt_prepare($ck,$select)){
                 echo  "statement failed!";
             }else{
                 mysqli_stmt_execute($ck);
                 $reslut= mysqli_stmt_get_result($ck);
                 $rowsNum= mysqli_num_rows($reslut);
                 $setImage= $rowsNum+1;
                 $sql= "INSERT INTO nameOfTable () VALUES (? , ? , ? , ? )";
                 if (! mysqli_stmt_prepare($ck,$select)){
                     echo  "statement failed!";
                 }else{
                     mysqli_stmt_bind_param($ck,"ssss",$title,$fileDis,$imageName,$setImage);
                     mysqli_stmt_execute($ck);
                     move_uploaded_file($fileTmpName,$fileDestination);
                     header('location : gallery.php?upload=success');
                 }
             }
             //  $res=mysqli_query($db,$select);

           }

       }else{
           echo "the image size is too big!";
       }
   }else{
       echo "you had an error!";



   }
}
