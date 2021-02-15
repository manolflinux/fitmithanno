<?php
require_once "../config.php";

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

if (isset($_SESSION['access_token'])) {
    unset($_SESSION['access_token']);
    $gClient->revokeToken();
    session_destroy();
    header('Location: login.php');
    exit();
}

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit;
}
