<?php
ob_start();
session_start();
require_once '../config.php';
include('../workouts/navbarWod.php');



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




if ($_POST) {

    $wodId = $_POST['wodId'];
    $rating = $_POST['rating'];
    $ratingText = $_POST['anmerkung'];

    $sql = "INSERT into rating (rating, wodId, userId, ratingText)  values ('$rating', '$wodId', '$userId', '$ratingText')";

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../style.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <title>Rating</title>
    </head>

    <body>



    <?php


    if ($conn->query($sql) === TRUE) {
        echo "<div class= 'text-dark pt-2 pb-2'>";
        echo "<p><center><b> Danke für dein Rating</b></center></p>";
        header("refresh:2; url= ../home.php");
        echo "<img src='../images/icon/icon_rudi.svg' >";
    } else {
        echo "Error " . $sql . ' ' . $conn->connect_error;
    }

    $conn->close();
}

    ?>

    </body>

    </html>