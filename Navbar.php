<?php
session_start();
include("message.php");

?>

<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-secondary pulse animated text-uppercase" id="mainNav">
    <div class="container">
        <a class="navbar-brand text-capitalize js-scroll-trigger" href="./index.php ">
            <img data-aos="fade-right" data-aos-duration="1700" src="assets/img/php%20(1).png" style="height: 64px;margin-top: -12px;">Php project
        </a>
        <button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="nav navbar-nav ml-auto">
                <?php require_once("Keepmelogin.php");?>
            </ul>
        </div>
    </div>
</nav>