<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register</title>

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
    include("connection.php");
    //Jiaying's register part with database connection

    //Check same password (password + repeat) for confirmation
    $username = "";
    $phone = "";
    $password = "";
    $confirmpass = "";
    $hash = null;
    if (!isset($_POST['signup'])) {
    } else {
        $username = $_POST['username'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirmpass = $_POST['confirm-password'];
        if ($_POST['password'] != $_POST['confirm-password']) {
            $_SESSION['message'] = "First password and confirm password is not the same! Try again.";
            $_SESSION['type'] = "danger";
            echo "
                <script>
                location.href = 'Register.php';
                </script>
                ";
        } else {
            $hash = sha1($_POST['password']);
        }

        //Check validity of data entered for username
        $duplicate = mysqli_query($conn, "select * from member where username='" . $username . "'");
        if (mysqli_num_rows($duplicate) > 0) {
            $_SESSION['message'] = "Username already exists! Try use another username.";
            $_SESSION['type'] = "danger";
            echo "
                <script>
                location.href = 'Register.php';
                </script>
                ";
        }


        //After everything correct
        if (!empty($hash) && mysqli_num_rows($duplicate) == 0) {
            $query = "insert into member values ('$username','$hash','$phone')";
            if (mysqli_query($conn, $query)) {
                $_SESSION['message'] = "Register Sucessfully! </br> username: " . $username . "</br> Phone number: " . $phone;
                $_SESSION['type'] = "success";
                echo "
                <script>
                location.href = 'Login.php';
                </script>
                ";
            } else {
                $_SESSION['message'] = "Failure to register: " .  mysqli_error($conn);
                $_SESSION['type'] = "danger";
                echo "
                <script>
                location.href = 'Register.php';
                </script>
                ";
            }
        }
    }

    ?>


    <div class="register-photo">
        <div class="border rounded form-container">
            <div class="image-holder"> </div>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <h2 class="text-center" style="font-size: 25px;color: rgb(255,255,255);width: 270px;">
                    Register an account</h2>
                <div class="form-group">
                    <input class="form-control" type="text" name="username" value="<?php echo $username ?>" required
                        placeholder="Username">
                </div>
                <div class="form-group">
                    <input id="password-field" class="form-control" value="<?php echo $password ?>" type="password"
                        name="password" placeholder="Password" minlength="1" maxlength="25" required="">
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"
                        style="color:white;"></span>
                </div>
                <div class="form-group">
                    <input id="password-field2" class="form-control" value="<?php echo $confirmpass ?>" type="password"
                        name="confirm-password" placeholder="confirm Password" minlength="1" maxlength="25" required="">
                    <span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password2"
                        style="color:white;"></span>
                </div>
                <div class="form-group">
                    <input class="form-control" type="tel" name="phone" placeholder="Phone" value="<?php echo $phone ?>"
                        required>
                </div>
                <div class="form-group">
                    <div class="form-check"><label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="checkbox" required>I agree to the
                            license terms.</label>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" name="signup" type="submit">Sign Up</button>
                </div>
                <a href="./login.php">You already have an account? Login here.</a>
            </form>
        </div>
    </div>
</body>
<?php

include("Footer.php");
include("jslinks.php");
?>

</html>