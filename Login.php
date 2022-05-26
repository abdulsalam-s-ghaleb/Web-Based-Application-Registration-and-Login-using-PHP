<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
    <?php
    include("csslinks.php");
    $page = null;
    if (isset($_SESSION['username'])) {
        $page = 0;
    }
    ?>
</head>

<body>
    <?php
    include("navbar.php");
    include_once('connection.php');
    $username = "";
    $hash = null;
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $hash = sha1($_POST['password']);

        $usercheck = mysqli_query($conn, "select username from smartiesproject1.member where username='" . $username . "'");
        $passcheck = mysqli_query($conn, "select password_hash from smartiesproject1.member where username='" . $username . "'");

        if (mysqli_num_rows($usercheck) > 0) {
            $row = mysqli_fetch_array($passcheck);
            if ($row['password_hash'] == $hash) {
                $_SESSION['message'] = "Successful Login! Welcome to Smarties PHP Group Project! 🙋‍♀️🙋‍♂️😁";
                $_SESSION['type'] = "success";
                $_SESSION['logined'] = true;
                $_SESSION['username'] = $username;
                //remember me cookies and it set The cookie that expire after 30 days  
                if (isset($_POST['rememberme'])) {
                    setcookie("rememberme", $_SESSION['username'], time() + (10), "/");
                } elseif (!isset($_POST['rememberme'])) {
                    setcookie("rememberme", "", time() - 1,);
                }
                echo "
                <script>
                location.href = 'Form.php';
                </script>
                ";
            } else {
                $_SESSION['message'] = "Incorrect Password! Failed Login, try again.";
                $_SESSION['type'] = "danger";
                echo "
                <script>
                location.href = 'Login.php';
                </script>
                ";
            }
        } else {
            $_SESSION['message'] = "Username does not exist! Failed Login, try again.";
            $_SESSION['type'] = "danger";
            echo "
                <script>
                location.href = 'Login.php';
                </script>
                ";
        }
    }
    ?>
    <div class="login-dark">
        <form class="border rounded-0" method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration">
                <i class="icon ion-ios-locked-outline"></i>
            </div>
            <div class="form-group"><input class="form-control" type="text" name="username" placeholder="Username"
                    minlength="1" maxlength="16" required=""></div>
            <div class="form-group">
                <input id="password-field" class="form-control" type="password" name="password" placeholder="Password"
                    minlength="1" maxlength="25" required="">
                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="formCheck-1" name="rememberme">
                <label class="form-check-label" for="formCheck-1">Remember me</label>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" name="submit" type="submit">Log In</button>
            </div>
            <a href="./Resetpassword.php">Reset your Username or password?</a>
        </form>

    </div>

</body>
<?php

include("Footer.php");
include("jslinks.php");
?>

</html>