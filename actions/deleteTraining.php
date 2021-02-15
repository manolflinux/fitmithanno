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

if ($_GET['kalenderId']) {
    $kalenderId = $_GET['kalenderId'];

    $sql = "SELECT * FROM kalender WHERE kalenderId = $kalenderId";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();

    $conn->close();

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Training löschen</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="../style.css">
    </head>

    <body>


        <hr>

        <h3 class="text-center">Training wirklich löschen?</h3>

        <div class="text-center">
            <form action="a_deleteTraining.php" method="post">

                <input type="hidden" name="kalenderId" value="<?php echo $data['kalenderId'] ?>" />
                <button type="submit" class="button_bee text-center rounded">Löschen</button>
                <a href="../home.php"><button type="button" class=" button_bee rounded">Abbrechen</button></a>
            </form>
        </div>

    </body>

    </html>

<?php
}
?>