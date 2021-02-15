<?php
ob_start();
session_start();
require_once '../config.php';

if (!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superadmin'])) {
    header("Location: ../index.php");
    exit;
}
if (isset($_SESSION["user"])) {
    header("Location: ../home.php");
    exit;
}

// select logged-in users details
if (isset($_SESSION["admin"])) {
    $userId = $_SESSION['admin'];
}

if (isset($_SESSION["superadmin"])) {

    $userId = $_SESSION['superadmin'];
}


// select logged-in users details
$res = mysqli_query($conn, "SELECT * FROM users WHERE userId=$userId");
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

include('navbarAdmin.php');

if ($_POST) {
    $wodId = $_POST['wodId'];

    $sql = "DELETE FROM wod WHERE wodId = $wodId";

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../style.css">
        <title>Delete Workout</title>
    </head>

    <body>


    <?php

    if ($conn->query($sql) === TRUE) {
        echo "<div class='text-center'>";
        echo "<p><b>Successfully deleted!!</b></p>";
        header("refresh:2; url=admin.php");
        echo "You will be redirected in 2 seconds.<br>";
        echo "<a href='.php'><button type='button'>Back</button></a>";
        echo "</div>";
    } else {
        echo "Error updating record : " . $conn->error;
    }

    $conn->close();
}

    ?>

    </body>

    </html>