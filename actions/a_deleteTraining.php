<?php
ob_start();
session_start();
require_once '../config.php';

if ((!isset($_SESSION['user'])) && (!isset($_SESSION['access_token']))) {

    header("Location: index.php");
    exit;
}

if (isset($_SESSION["user"])) {
    $res = mysqli_query($conn, "SELECT * FROM users WHERE userId=" . $_SESSION['user']);
    $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $userId = $_SESSION['user'];
}


if (isset($_SESSION['access_token'])) {

    $res = mysqli_query($conn, "SELECT * FROM users WHERE oauth_uid=" . $_SESSION['id']);
    $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $userId = $userRow['userId'];
}


// select logged-in users details
$res = mysqli_query($conn, "SELECT * FROM users WHERE userId=$userId");
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);



// select logged-in users details
$res = mysqli_query($conn, "SELECT * FROM users WHERE userId=$userId");
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

include('../workouts/navbarWod.php');


if ($_POST) {
    $kalenderId = $_POST['kalenderId'];

    $sql = "DELETE FROM kalender WHERE kalenderId = $kalenderId";

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../style.css">
        <title>Training löschen</title>
    </head>

    <body>


    <?php

    if ($conn->query($sql) === TRUE) {
        echo "<div class='text-center'>";
        echo "<h2>Training wurde gelöscht</h2>";
        header("refresh:2; url= ../home.php");
        echo "Weiterleitung erfolgt in 2 Sekunden<br>";
        echo "<a href='../home.php'><button class='button_bee rounded'type='button'>myHanno</button></a>";
        echo "</div>";
    } else {
        echo "Error updating record : " . $conn->error;
    }

    $conn->close();
}

    ?>

    </body>

    </html>