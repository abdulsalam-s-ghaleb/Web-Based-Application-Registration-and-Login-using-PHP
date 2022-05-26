<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Untitled</title>

    <?php
    $page = 2;
    include("csslinks.php");
    ?>
</head>

<body>
    <?php
    include("navbar.php");
    include_once('connection.php');
    if (!isset($_SESSION['reset_pass_username']) && !isset($_SESSION['username'])) {
        echo "
                    <script>
                    location.href = 'Resetpassword.php';
                    </script>
                    ";
    }
    $username = "";
    $currentpwd = "";
    $newpwd = "";
    $confirmpwd = "";
    if (isset($_POST['submit'])) {

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $currentpwd = $_POST['curr-pass'];
        $newpwd = $_POST['new-pass'];
        $confirmpwd = $_POST['new-confirm-pass'];
        $oldhash = sha1($currentpwd);

        if ($newpwd != $confirmpwd) {
            $_SESSION['message'] = "New password and confirm password is not the same! Try again.";
            $_SESSION['type'] = "danger";
        } else {
            $hash = sha1($newpwd);
        }

        $CPquery = mysqli_query($conn, "SELECT username,password_hash FROM smartiesproject1.member where username = '$username' AND password_hash='$oldhash' ");
        $num =  mysqli_fetch_array($CPquery);
        if ($num == 0) {
            $_SESSION['message'] = 'Username or Current Password does not exists';
            $_SESSION['type'] = 'danger';
        }

        if ($newpwd != $confirmpwd || $num == 0) {
            include("message.php");
        } elseif (!empty($hash) && $num > 0) {
            $query = "UPDATE member set password_hash = '$hash' where username = '$username'";
            if (mysqli_query($conn, $query)) {
                $_SESSION['message'] = 'Password changed successfully!';
                $_SESSION['type'] = 'success';
                if (isset($_SESSION['username'])) {
                    echo "
                    <script>
                    location.href = 'index.php';
                    </script>
                    ";
                } else {
                    echo "
                    <script>
                    location.href = 'Login.php';
                    </script>
                    ";
                }
            } else {
                $_SESSION['message'] = 'Failure to changed password: ' . mysqli_error($conn);
                $_SESSION['type'] = 'danger';
                include("message.php");
            }
        }
    }

    ?>
    <div class="login-dark">
        <form class="border rounded-0" method="post" style="background-color:#1f3145;"
            action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h2 style="font-size: 25px;color: rgb(255,255,255);width: 310px; margin-left:-30px;">Change your password
            </h2>
            <div class=" illustration">
                <i class="fa fa-wrench" style="font-size: 130px;"></i>
            </div>
            <div class=" form-group">
                <input class="form-control" value="<?php if (isset($_SESSION['username'])) {
                                                        echo $_SESSION['username'];
                                                    } elseif (isset($_SESSION['reset_pass_username'])) {
                                                        echo $_SESSION['reset_pass_username'];
                                                    } else {
                                                        echo $username;
                                                    } ?>" type="text" name="username" readonly placeholder="Username">
            </div>
            <div class="form-group">

                <input id="password-field" value="<?php if (isset($_SESSION['Random_pass']) && !isset($_SESSION['username'])) {
                                                        echo $_SESSION['Random_pass'];
                                                    } else {
                                                        echo $currentpwd;
                                                    } ?>" class="form-control" type="password" name="curr-pass"
                    placeholder="Current password" minlength="1" maxlength="25" required="">
                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
            <div class="form-group">

                <input id="password-field2" value="<?php echo $newpwd; ?>" class="form-control" type="password"
                    name="new-pass" placeholder="New password" minlength="1" maxlength="25" required="">
                <span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
            </div>
            <div class="form-group">

                <input id="password-field3" value="<?php echo $confirmpwd; ?>" class="form-control" type="password"
                    name="new-confirm-pass" placeholder="Confirm new password" minlength="1" maxlength="25" required="">
                <span toggle="#password-field3" class="fa fa-fw fa-eye field-icon toggle-password3"></span>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" name="submit" type="submit">Change Password</button>
            </div>
            <a href="./Resetpassword.php">Go back</a>
        </form>
    </div>


</body>
<?php

include("Footer.php");
include("jslinks.php");
?>

</html>