<style>
.dropbtn {
    background-color: #17a2b8;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: 25px;
    border-radius: 5px;

}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    /* display: none;
        position: absolute; */
    /* background-color: #2C3E50; */
    /* border: inset; */
    /* border-width: 4px;
        border-radius: 20px; */


    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: fit-content;
    text-align: center;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    display: block;
    /* border-bottom: solid;
        border-radius: 20px;
        border-width: 4px; */
    font-size: 15px;
    text-transform: none;
    white-space: nowrap;



}

.dropdown-content a:hover {
    background-color: #ddd;
    /* border-bottom: solid;
        border-radius: 20px;
        border-width: 4px; */


}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #28a745;
}
</style>

<?php

//remember me cookies 
if (isset($_COOKIE['rememberme'])) {
    $_SESSION['logined'] = true;
    $_SESSION['username'] = $_COOKIE['rememberme'];
}

if (!isset($_SESSION['logined'])) {

?>
<li class="nav-item mx-0 mx-lg-1" role="presentation" style="width: fit-content;margin-top:7px;">
    <a class="nav-link bg-primary py-3 px-0 px-lg-3 rounded js-scroll-trigger" data-aos="fade-right"
        data-aos-duration="1100" href="./register.php"
        style="margin-right: 15px;margin-left: 15px;text-align: center;">&nbsp Register <i class="fa fa-wpforms"
            style="font-size: 22px;">&nbsp
        </i>
    </a>
</li>
<li class="nav-item mx-0 mx-lg-1" role="presentation" style="width: fit-content;margin-top:7px;">
    <a class="nav-link text-uppercase bg-info py-3 px-0 px-lg-3 rounded js-scroll-trigger" data-aos="fade-left"
        data-aos-duration="1100" href="./login.php" style="margin-right: 15px;margin-left: 15px;text-align: center;">
        &nbsp Login <i class="fa fa-arrow-circle-o-right" style="font-size: 22px;">&nbsp</i>
    </a>
</li>

<?php
    if (isset($page)) {
        if ($page == 1) {
            echo "
            <script>
            location.href = 'Login.php';
            </script>
            ";
        }
    }
} elseif (isset($_SESSION['logined'])) {

    ?>


<div class="dropdown">
    <button class="dropbtn"><strong><?php if (isset($_COOKIE['rememberme'])) {
                                            echo "{$_COOKIE['rememberme']}" . "&nbsp";
                                        } else {
                                            echo $_SESSION['username'];
                                        } ?> <i class="fa fa-user-circle"
                style="font-size: 20px;"></i></strong></button>
    <div class="dropdown-content">
        <a href="./Index.php">Home</a>
        <a href="./Form.php">Submit Form</a>
        <a href="./Submited.php">Last Form</a>
        <a href="./Changepassword.php">Change Password</a>
        <a href="./Logout.php">Logout</a>
    </div>
</div>

<?php
    if ($page == 0) {
        echo "
            <script>
            location.href = 'Form.php';
            </script>
            ";
    }
}

?>