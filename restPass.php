<?php
session_start();
include ('connection.php');

if (isset($_POST['resPassword'])) {
$pass1 = mysqli_real_escape_string($db, $_POST['pass1']);
$pass2 = mysqli_real_escape_string($db, $_POST['pass2']);
if ($pass1 != $pass2) {
array_push($errors, "Passwords do not match");
header('location: login.php?password=not==match');
exit();
} else {
$password = password_hash($pass2, PASSWORD_DEFAULT);
$username = $_SESSION['mo'];
$up = "UPDATE login  SET password= '$password' WHERE username='$username' OR email='$username'";
$update = mysqli_query($db, $up);
header('location : login.php?passwordUpdated==success');
exit();
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<div >
    <form class="modal-content animate" method="post" action="restPass.php">
        <div class="imgcontainer">
                            <span onclick="document.getElementById('res').style.display='none'" class="close"
                                  title="Close Modal">&times;</span>
        </div>

        <label for="username"><b>Password</b></label>
        <input class="justMo" type="password" placeholder="Password..." name="pass1">
        <label for="username"><b>Confirm Password</b></label>
        <input class="justMo" type="password" placeholder="Confirm Password.." name="pass2">
        <button class="button1" name="resPassword" type="submit">Submit</button>
        <button type="button" onclick="document.getElementById('res').style.display='none'" class="#">
            Cancel
        </button>
    </form>
</div>
</body>
</html>