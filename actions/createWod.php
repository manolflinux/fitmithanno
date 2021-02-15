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

    $wodName = $_POST['wodName'];
    $trainedParts = $_POST['trainedParts'];
    $equiSetId = $_POST['equipment'];
    $description = $_POST['description'];
    $durationInMinutes = $_POST['durationInMinutes'];
    $difficulty = $_POST['difficulty'];
    $link = $_POST['link'];


    $sql = "INSERT into wod (wodName, trainedParts, equiSetId, description, durationInMinutes, difficulty, link, userId)  values ('$wodName', '$trainedParts','$equiSetId', '$description','$durationInMinutes','$difficulty', '$link','$userId')";

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../style.css">
        <title>Add Workout</title>
    </head>

    <body>

    </body>

    </html>


<?php


    if ($conn->query($sql) === TRUE) {
        echo "<div class= 'text-dark pt-2 pb-2'>";
        echo "<p><center><b>Neues Workout wurde erstellt</b></center></p>";
        echo "<p><center><b><New Workout Successfully Created</b></center></p>";
        header("refresh:2; url=../home.php");
        echo "<center>You will be redirected in 2 seconds.</center>";
        echo "</div>";
    } else {
        echo "Error " . $sql . ' ' . $conn->connect_error;
    }

    $conn->close();
}

?>