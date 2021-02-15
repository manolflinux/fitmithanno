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



if ($_GET['wodId']) {
    $wodId = $_GET['wodId'];

    $sql = "SELECT * FROM wod WHERE wodId = $wodId";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();

    $conn->close();
    include('navbarAdmin.php');
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

        <h3 class="text-center">Do you really want to delete this workout</h3>

        <div class="text-center">
            <form action="a_delete.php" method="post">

                <input type="hidden" name="wodId" value="<?php echo $data['wodId'] ?>" />
                <button type="submit" class="text-center">Yes, delete it!</button>
                <a href="admin.php"><button type="button">No, go back!</button></a>
            </form>
        </div>

    </body>

    </html>

<?php
}
?>