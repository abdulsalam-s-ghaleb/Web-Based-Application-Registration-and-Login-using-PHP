<?php

session_start();
header("Location:Login.php");
setcookie("rememberme", "", time() - 1, "/");
session_destroy();
session_start();
$_SESSION['message'] = "You logged out successfully! bye 👋 😊";
$_SESSION['type'] = "warning";