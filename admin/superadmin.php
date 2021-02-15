<?php
ob_start();
session_start();
require_once '../config.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superadmin'])) {
    header("Location: ../index.php");
    exit;
}
if (isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}
if (isset($_SESSION["user"])) {
    header("Location: ../home.php");
    exit;
}

// select logged-in users details
$res = mysqli_query($conn, "SELECT * FROM users WHERE userId=" . $_SESSION['superadmin']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

include('navbarAdmin.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Title Page-->
    <title>User Information</title>

</head>

<body>

    <div class="containerSuperadmin">

        <table class="table">
            <thead class="thead-dark" style="position: sticky;top: 0">
                <tr>
                    <th class="header" scope=" col">ID</th>
                    <th class="header" scope="col">Name</th>
                    <th class="header" scope="col">Email</th>
                    <th class="header" scope="col">Count done Wods</th>
                    <th class="header" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php


                $sql = "SELECT * FROM users
            where users.status = 'user'";
                $res = $conn->query($sql);


                while ($row = mysqli_fetch_assoc($res)) {
                    $userId = $row['userId'];
                    $name = $row['userName'];
                    $email = $row['userEmail'];

                    $sql2 = "select count(wodId) as 'count' from calendar
                    where userId = $userId
                    and COALESCE(wodId,'')";
                    $res2 = $conn->query($sql2);
                    $data2 = $res2->fetch_assoc();
                    $countWod = $data2['count'];


                    echo "<tr>";
                    echo "<td class='table-admin'>$userId</td>";
                    echo "<td class='table-admin'>$name</td>";
                    echo "<td class='table-admin'>$email</td>";
                    echo "<td class='table-admin'>$countWod</td>";

                    echo "<td><a href='userview.php?userId=$userId' class='btn btn-outline-info btn-sm' target='_blank'>see UserCalendar </a> 
            </td>";
                    echo "</tr> ";
                }


                // Free result set
                mysqli_free_result($res);
                // Close connection
                mysqli_close($conn);

                ?>

    </div>


</body>

</html>