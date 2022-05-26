<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <?php
    $page = 1;


    include("csslinks.php");

    ?>
    <style>
    #btn-form {

        background-color: #2c3e50;
        width: 250px;
        font-size: bold;
        margin: auto;

    }

    ::-webkit-file-upload-button {
        background-color: #2c3e50;
        width: auto;
        font-size: bold;
        margin: auto;
        margin-right: 10px;
        color: white;
    }
    </style>
</head>

<body>
    <?php
    include("navbar.php");
    include_once('connection.php');

    // // if one time form should submit to database
    // $result = mysqli_query($conn, "SELECT * FROM submitform where username='{$_SESSION['username']}'") or die(mysqli_error($con));
    // $num = mysqli_num_rows($result);
    // if ($num > 0) {
    //     echo "
    //         <script>
    //         location.href = 'Submited.php';
    //         </script>
    //         ";
    // }




    if (isset($_POST['submit'])) {  // if submit button on the form is clicked
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email =  mysqli_real_escape_string($conn, $_POST['email']);
        $age =  mysqli_real_escape_string($conn, $_POST['age']);
        $birthdate =  mysqli_real_escape_string($conn, $_POST['birthdate']);
        $favorite = $_POST['check'];
        $gender = mysqli_real_escape_string($conn, $_POST['check1']);
        $eyecolor = mysqli_real_escape_string($conn, $_POST['eyecolor']);
        $bio =  mysqli_real_escape_string($conn, $_POST['bio']);
        $url =  mysqli_real_escape_string($conn, $_POST['url']);
        $color =  mysqli_real_escape_string($conn, $_POST['color']);
        $chk = "";
        foreach ($favorite as $chk1) {
            $chk .= $chk1 . ", ";
        }

        // Uploads files
        $sfile = rand(1000, 10000) . "-" . $_FILES["sfile"]["name"];
        $temp_sfile = $_FILES["sfile"]["tmp_name"];
        $dir = './assets/uploads';
        move_uploaded_file($temp_sfile, $dir . '/' . $sfile);
        /// Uploads files
        $query = "insert into submitform (`formID`, `username`,`name`, `email`, `age`, `birthdate`, `favoriteFood`, `gender`, `eyeColor`, `bio`, `filename`, `URL`, `color`)  values ('','{$_SESSION['username']}','$name','$email','$age', '$birthdate','$chk','$gender','$eyecolor','$bio','$sfile','$url','$color') ";
        if (mysqli_query($conn, $query)) {
            $_SESSION['message'] = "Submit Sucessfully! 👍🆗 ";
            $_SESSION['type'] = "success";
            echo "
            <script>
            location.href = 'Submited.php';
            </script>
            ";
        } else {
            $_SESSION['message'] = "Failure to register: " .  mysqli_error($conn);
            $_SESSION['type'] = "danger";
            include("message.php");
        }
    }


    ?>
    <div class="register-photo">
        <div class="border rounded form-container" style="width: 500px;  ">
            <form method="post" style="margin:auto;" enctype="multipart/form-data">
                <div style="margin:auto;">
                    <div class="form-group d-xl-flex justify-content-xl-start align-items-xl-center">
                        <label class="d-xl-flex justify-content-xl-start align-items-xl-center" for="btn-form"
                            style="font-size: 20px; color:white;">Name: </label>
                        <input class="form-control d-xl-flex justify-content-xl-start align-items-xl-center"
                            id="btn-form" type="text" name="name" required />
                    </div>
                    <div class="form-group d-xl-flex justify-content-xl-start align-items-xl-center">
                        <label class="d-xl-flex justify-content-xl-start align-items-xl-center"
                            style="font-size: 20px; color:white;">Email: </label>
                        <input class="form-control d-xl-flex justify-content-xl-start align-items-xl-center"
                            id="btn-form" type="email" name="email" required />
                    </div>
                    <div class="form-group d-xl-flex justify-content-xl-start align-items-xl-center">
                        <label class="d-xl-flex justify-content-xl-start align-items-xl-center"
                            style="font-size: 20px; color:white;">Age: </label>
                        <input class="form-control d-xl-flex justify-content-xl-start align-items-xl-center"
                            id="btn-form" type="number" min="3" step="1" max="100" name="age" required />
                    </div>
                    <div class="form-group d-xl-flex justify-content-xl-start align-items-xl-center">
                        <label class="d-xl-flex justify-content-xl-start align-items-xl-center"
                            style="font-size: 20px; color:white;">Birthdate: </label>
                        <input class="form-control d-xl-flex justify-content-xl-start align-items-xl-center"
                            id="btn-form" type="date" min="1989-12-31" max="<?php echo date('Y-m-d'); ?>"
                            data-type="datetime" name="birthdate" required />
                    </div>
                    <div class="form-group d-xl-flex justify-content-xl-start align-items-xl-center">
                        <label class="d-xl-flex justify-content-xl-start align-items-xl-center"
                            style="font-size: 20px; color:white;">Favorite Food: </label>
                        <div id="btn-form" style="width:fit-content; margin-left: 110px; background-color:#1e2833">
                            <div class="form-group d-xl-flex justify-content-xl-start align-items-xl-center row"
                                style="margin:auto;">
                                <label class="d-xl-flex" for="cbbanana" style="font-size: 20px; color:white;">Banana
                                </label>
                                <input type="checkbox" name="check[]" id="cbbanana" value="Banana"
                                    style="margin-left:10px" />
                            </div>
                            <div class="form-group d-xl-flex justify-content-xl-start align-items-xl-center row"
                                style="margin:auto">
                                <label class="d-xl-flex " for="cbapple" style="font-size: 20px; color:white;">Apple
                                </label>
                                <input type="checkbox" name="check[]" id="cbapple" value="Apple"
                                    style="margin-left:10px" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-xl-flex justify-content-xl-start align-items-xl-center">
                        <label class="d-xl-flex justify-content-xl-start align-items-xl-center"
                            style="font-size: 20px; color:white;">Gender: </label>
                        <div id="btn-form" style="width:fit-content; margin-left: 170px; background-color:#1e2833">
                            <div class="form-group d-xl-flex justify-content-xl-start align-items-xl-center row"
                                style="margin:auto">
                                <label class="d-xl-flex " for="cbbanana" style="font-size: 20px; color:white;">Male
                                </label>
                                <input type="radio" onclick="onlyOne2(this)" name="check1" id="cbbanana" value="Male"
                                    style="margin-left:10px" />
                            </div>
                            <div class="form-group d-xl-flex justify-content-xl-start align-items-xl-center row"
                                style="margin:auto">
                                <label class="d-xl-flex " for="cbapple" style="font-size: 20px; color:white;">Female
                                </label>
                                <input type="radio" onclick="onlyOne2(this)" name="check1" id="cbapple" value="Female"
                                    style="margin-left:10px" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-xl-flex justify-content-xl-start align-items-xl-center">
                        <label class="d-xl-flex justify-content-xl-start align-items-xl-center" for="Birthdate"
                            style="font-size: 20px; color:white;">Eye Color: </label>
                        <select class="form-control d-xl-flex justify-content-xl-start align-items-xl-center"
                            multiple="multiple" required name="eyecolor" id="btn-form"
                            style="height:60px; border-radius:0px">
                            <option value="Green">Green</option>
                            <option label="Red" value="Red"></option>
                            <option label="Blue" value="Blue"></option>
                        </select>

                    </div>
                    <div class="form-group d-xl-flex justify-content-xl-start align-items-xl-center">
                        <label class="d-xl-flex justify-content-xl-start align-items-xl-center" for="bio"
                            style="font-size: 20px; color:white;">Bio: </label>
                        <textarea class="form-control d-xl-flex justify-content-xl-start align-items-xl-center"
                            id="btn-form" name="bio" style="margin-left:200px;height:60px; border-radius:0px"
                            required> </textarea>
                    </div>
                    <div class="form-group d-xl-flex justify-content-xl-start align-items-xl-center">
                        <label for="file" style="font-size: 20px; color:white;">File: </label>
                        <input type="file" name="sfile" id="file" style="margin-left:200px;font-size:20px; color:white;"
                            required />
                    </div>
                    <div class="form-group d-xl-flex justify-content-xl-start align-items-xl-center">
                        <label class="d-xl-flex justify-content-xl-start align-items-xl-center"
                            style="font-size: 20px; color:white;">URL: </label>
                        <input class="form-control d-xl-flex justify-content-xl-start align-items-xl-center" type="url"
                            name="url" id="btn-form" style="margin-left:200px;" required />
                    </div>
                    <div class="form-group d-xl-flex justify-content-xl-start align-items-xl-center">
                        <label class="d-xl-flex justify-content-xl-start align-items-xl-center"
                            style="font-size: 20px; color:white;">Favorite Color: </label>
                        <input class="form-control d-xl-flex justify-content-xl-start align-items-xl-center"
                            type="color" name="color" id="btn-form" style="width:100px; border-radius:0px; border:none;"
                            required />
                    </div>
                    <div class="form-group" style="margin-left:150px;">
                        <button class="btn btn-primary btn" style="width: 150px; margin:10px 25px 10px -10px;"
                            name="reset" type="reset">Reset</button>
                        <button class="btn btn-primary btn" style="width: 150px; margin:10px 25px 10px 30px;"
                            name="submit" type="submit">Submit</button>
                    </div>
                </div>
            </form>


        </div>

    </div>
    <script>
    //only one is selected from checkboxes for Gender
    function onlyOne2(checkbox) {
        var checkboxes = document.getElementsByName('check1')
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false
        })
    }
    </script>

</body>
<?php
include("Footer.php");
include("jslinks.php");
?>

</html>