<?php
session_start();
include ('connection.php');

if (isset($_POST['answer'])) {
$awnr1 = mysqli_real_escape_string($db, $_POST['answer1']);
$awnr2 = mysqli_real_escape_string($db, $_POST['answer2']);

if (empty($awnr1) || empty($awnr2)) {
    header('location : ../login.php?answer==empty');
    exit();
} else {

    $anser1 = $_SESSION['n1'];
    $anser2 = $_SESSION['n2'];

    $answer1 = password_verify($awnr1, $anser1);
    $answer2 = password_verify($awnr2, $anser2);

    if (($answer1 == false) || ($answer2 == false)) {
        array_push($errors, "Was wrong Password");
        header('location: login.php?password_wrong_user');
        exit();
    }
    else{
    header('location: restPass.php?allGood');
    exit();
    }
}
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/admin.css">
    <meta charset="UTF-8">
    <title>Answer security questions</title>
</head>
<body>

<div >
    <form class="modal-content animate" method="post" action="questionAnswer.php">

        <h3>Please answer the security questions...</h3><br>
        <p><?php echo $_SESSION['q12'] ; ?></p><br>
        <input class="justMo" type="text" placeholder="answer 1...." name="answer1"><br><br>
        <p><?php echo   $_SESSION['q123'] ; ?></p><br>
        <input class="justMo" type="text" placeholder="answer 2...." name="answer2"><br><br>
        <button class="button1" name="answer" type="submit">Submit</button>
    </form>
</div>

</body>
</html>