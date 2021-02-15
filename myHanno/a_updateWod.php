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

include('../workouts/navbarWod.php');


if ($_POST) {
 
    $wodId = $_POST['wodId'];
    $wodName = $_POST['wodName'];
    $trainedParts = $_POST['trainedParts'];
    $equiSetId = $_POST['equipment'];
    $description = $_POST['description'];
    $durationInMinutes = $_POST['durationInMinutes'];
    $difficulty = $_POST['difficulty'];
    // $points = $_POST['points'];
    $link = $_POST['link'];

    $sql = "UPDATE wod SET wodName = '$wodName', trainedParts = '$trainedParts', equiSetId = '$equiSetId', description = '$description', durationInMinutes = '$durationInMinutes', difficulty = '$difficulty', link = '$link' WHERE wodId = $wodId";

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../style.css">
        <title>Update Workout</title>
    </head>

    <body>


    </body>

    </html>

<?php
    if (mysqli_query($conn, $sql)) {
        // if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
        echo "<div class='text-center mt-4'>";
        echo "<h2>Workout erfolgreich upgedated </h2><br> <a href='../home.php'><button type='button' class='btn-outline-warning'>myHanno</button></a><br>";
        header("refresh:2; url= ../home.php");
        echo "Weiterleitung erfolgt in 2 Sekunden";
        echo "</div>";
    } else {
        echo "Error while updating record : " . $conn->error;
    }


    $conn->close();
}

?>