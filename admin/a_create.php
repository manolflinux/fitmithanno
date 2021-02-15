<?php
ob_start();
session_start();
require_once '../config.php';

if (!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superadmin'])) {
    // if (!isset($_SESSION['superadmin']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}
// select logged-in users details
if (isset($_SESSION["admin"])) {

    $res = mysqli_query($conn, "SELECT * FROM users WHERE userId=" . $_SESSION['admin']);
    $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $userId = $_SESSION['admin'];
}

if (isset($_SESSION["superadmin"])) {

    $res = mysqli_query($conn, "SELECT * FROM users WHERE userId=" . $_SESSION['superadmin']);
    $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $userId = $_SESSION['superadmin'];
}




if ($_POST) {

    $wodName = $_POST['wodName'];
    $trainedParts = $_POST['trainedParts'];
    $equiSetId = $_POST['equipment'];
    $description = $_POST['description'];
    $durationInMinutes = $_POST['durationInMinutes'];
    $difficulty = $_POST['difficulty'];
    $link = $_POST['link'];
    // $points = $_POST['points'];
    // $userId = $_SESSION['admin'];

    $sql = "INSERT into wod (wodName, trainedParts, equiSetId, description, durationInMinutes, difficulty, link, userId)  values ('$wodName', '$trainedParts','$equiSetId', '$description','$durationInMinutes','$difficulty', '$link','$userId')";
    include('navbarAdmin.php');
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
        echo "<p><center><b>Neuer Beitrag wurde erstellt</b></center></p>";
        echo "<p><center><b><New Record Successfully Created</b></center></p>";
        header("refresh:2; url=admin.php");
        echo "<center>You will be redirected in 2 seconds.</center>";
        echo "<center><a href='admin.php'><button type='button'>Home</button></a></center>";
        echo "</div>";
    } else {
        echo "Error " . $sql . ' ' . $conn->connect_error;
    }

    $conn->close();
}

?>