<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>create new password</title>
</head>
<body>

<div>
    <section>
        <?php
        $sector = mysqli_real_escape_string($db,$_POST['selector']);
        $validator = mysqli_real_escape_string($db,$_POST['validator']);

        if (empty($sector) || empty($validator)){
            echo "can not valid validate your requested";
        }else{
            if (ctype_xdigit($sector !== false && ctype_xdigit($validator) !==false)){
       ?>
                <form action="restPasswordInc.php" method="post">

                    <input type="hidden" name="selector" value="<?php echo $sector?>">
                    <input type="hidden" name="validator" value="<?php echo $validator?>">
                    <input type="password" name="pwd" placeholder="emter new password" >
                    <input type="password" name="con_pwd" placeholder="confirm password" >
                    <button type="submit" name="rest_pass_sub">Rest Password</button>
                </form>
        <?php
            }
        }
        ?>
    </section>
</div>

</body>
</html>