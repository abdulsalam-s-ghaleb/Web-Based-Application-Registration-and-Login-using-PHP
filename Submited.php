<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submited</title>
    <style>
        #table {
            color: white;
            font-size: bold;

            box-shadow: inset 0px 0px 10px 0px #868e96;
            border: 2px solid black;
            border-color: white;
            border-collapse: collapse;
            text-align: center;

        }
    </style>
    <?php
    $page = 1;
    include("csslinks.php");
    ?>
</head>

<body>
    <?php
    include("navbar.php");
    include_once('connection.php');
    ?>

    <div class="register-photo">
        <div class="border rounded form-container" style="width: 500px;  ">
            <div class="new-div" style="margin:auto;">
                <div style="margin:auto; ">
                    <div class="form-group d-xl-flex justify-content-xl-start align-items-xl-center" style="max-width:650px; min-width:550px">

                        <?php

                        $name = "";
                        $email = "";
                        $age = "";
                        $birthdate = "";
                        $favorite = "";
                        $gender = "";
                        $eyecolor = "";
                        $bio = "";
                        $file = "";
                        $url = "";
                        $color = "";
                        if (isset($_SESSION['username'])) {
                            $result = mysqli_query($conn, "SELECT * FROM submitform where username='{$_SESSION['username']}'") or die(mysqli_error($con));
                            $num = mysqli_num_rows($result);
                            if ($num > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $name = $row['name'];
                                    $email = $row['email'];
                                    $age = $row['age'];
                                    $birthdate = $row['birthdate'];
                                    $favorite = $row['favoriteFood'];
                                    $gender = $row['gender'];
                                    $eyecolor = $row['eyeColor'];
                                    $bio = $row['bio'];
                                    $file = $row['filename'];
                                    $url = $row['URL'];
                                    $color = $row['color'];
                                }
                                //////testing


                        ?>
                                <div class="table-responsive">
                                    <table border="2" class="table" id="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="table-dark">Field</th>
                                                <th scope="col" class="table-dark">Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="table-dark">Name</th>
                                                <td><?php echo $name; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="table-dark">Email</th>
                                                <td><?php echo $email; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="table-dark">Age</th>
                                                <td><?php echo $age; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="table-dark">Birthdate</th>
                                                <td><?php echo $birthdate; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="table-dark">Favorite Food</th>
                                                <td><?php echo $favorite; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="table-dark">Gender</th>
                                                <td><?php echo $gender; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="table-dark">Eye Color</th>
                                                <td><?php echo $eyecolor; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="table-dark">Bio</th>
                                                <td><?php echo $bio; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="table-dark">File</th>
                                                <td><img width="200px" src="<?php echo './assets/uploads/' . $file ?>"></br> <?php echo $file; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="table-dark">URL</th>
                                                <td>
                                                    <a href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="table-dark">Favorite Color</th>
                                                <td><label style="width:250px;color:<?php echo $color; ?>;background-color:<?php echo $color; ?>;"><?php echo $color; ?></label></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <a href="Index.php">Go to Home Page</a>
                                </div>
                            <?php


                            } else {

                            ?>

                                <h2 style="color:white;">There are no form have been submitted!!.</br> Go back to submit new form <a href="Form.php">BACK</a></h2>


                        <?php

                            }
                        } ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include("Footer.php");
include("jslinks.php");
?>

</html>