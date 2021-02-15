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


if ($_GET['wodId']) {
    $wodId = $_GET['wodId'];

    $sql = "SELECT * FROM wod WHERE wodId = $wodId";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();

    $conn->close();

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Delete </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="../style.css">
    </head>

    <body>


        <hr>

        <h3 class="text-center">Workout wirklich löschen?</h3>

        <div class="text-center">
            <form action="a_deleteWod.php" method="post">

                <input type="hidden" name="wodId" value="<?php echo $data['wodId'] ?>" />
                <button type="submit" class="text-center">Löschen</button>
                <a href="../home.php"><button type="button">Zurück</button></a>
            </form>
        </div>

    </body>

    </html>

<?php
}
?>