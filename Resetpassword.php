<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    if (isset($_SESSION['username'])) {
        $page = 0;
    }

    include("csslinks.php");

    ?>
</head>

<body>
    <?php
    include("navbar.php");
    include_once('connection.php');
    $username = "";
    $phone    = "";
    if (isset($_POST['submit'])) {
        $username = $_POST['reusername'];
        $phone = $_POST['rephone'];
        $RPquery = mysqli_query($conn, "SELECT username,phone FROM smartiesproject1.member where username = '$username' AND phone='$phone' ");
        $num =  mysqli_fetch_array($RPquery);
        $_SESSION['reset_pass_username'] =  $username;

        if ($num > 0) {
            // $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

            // api call 
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://www.passwordrandom.com/query?command=password',
                CURLOPT_USERAGENT => 'Password Generator'
            ]);
            // the password generated from REST API connection 
            $generated_password_API = curl_exec($curl);
            $generated_password_API_clear = preg_replace('/[^A-Za-z0-9]/', '', $generated_password_API); // Removes special chars. 
            $password = substr(str_shuffle($generated_password_API_clear), 0, 8);
            $hash = sha1($password);
            $con = mysqli_query($conn, "UPDATE member set password_hash = '$hash' where username = '$username' ");
            $_SESSION['message'] = "Your Password Is : " . $password;
            $_SESSION['type'] = "success";
            $_SESSION['Random_pass'] = $password;
            echo "
                <script>
                location.href = 'Changepassword.php';
                </script>
                ";
        } else {
            $_SESSION['message'] = "Username or Phone number invalid!!  " .  mysqli_error($conn);
            $_SESSION['type'] = "danger";
            include("message.php");
        }
    }
    ?>
    <div class="login-dark">
        <form class="border rounded-0" method="post" style="background-color:#1f3145;">
            <h2 style="font-size: 25px;color: rgb(255,255,255);width: 280px; margin:-15px;">
                Reset your password</h2>
            <div class=" illustration">
                <i class="icon ion-ios-unlocked"></i>
            </div>
            <div class="form-group"><input class="form-control" type="text" name="reusername" placeholder="Username"
                    minlength="1" maxlength="16" required=""></div>
            <div class="form-group"><input class="form-control" type="tel" name="rephone" placeholder="Phone"
                    minlength="1" maxlength="25" required=""></div>
            <div class="form-group"><button class="btn btn-primary btn-block" name="submit" type="submit"
                    style="font-weight: bold;">Reset password</button>
            </div>
            <a href="./Login.php">Go back to log in page</a>
        </form>
    </div>

</body>
<?php

include("Footer.php");
include("jslinks.php");
?>

</html>