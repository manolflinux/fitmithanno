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

    $sql = "SELECT * FROM kalender 
   WHERE kalenderId = $kalenderId";

    $result = $conn->query($sql);
    $data = $result->fetch_assoc();


?>

    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <title>Edit </title>
        <link rel="stylesheet" href="../style.css">
        <script src="https://cdn.tiny.cloud/1/fyga9b2vms5na1vvgr2ey9wn6ms9d7ucfg44hszp3i61u8ll/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#mytextarea',
                placeholder: "Hier kannst du deine Notizen erstellen und formatieren.."

            });
        </script>

    </head>

    <body>

        <div class="mx-auto">
            <div class="mx-auto">
                <h1 class="mx-auto text-warning">Update Training</h1>
            </div>


            <form action="a_updateTraining.php" class="mx-auto" method="post">
                <div class=" container font-weight-bold">

                    <div class="form-group">

                        <label for="Datum">Datum/Zeit: </label>
                        <input type="text" class="form-control mb-3" name="trainDate" value="<?php echo $data['trainDate'] ?>" />

                        <label for="comment">Notizen: </label>
                        <textarea class="form-control" id="mytextarea" rows="10" name="comment"> <?php echo $data['comment'] ?> </textarea>

                        <input type="hidden" name="kalenderId" value="<?php echo $data['kalenderId'] ?>" />

                        <input class="form-control btn btn-warning mt-3 mb-3" type="submit" name="submit" value="Änderungen speichern" />

                        <a href="../home.php" class="btn btn-block btn-dark">Zurück</a>

                    </div>



                </div>
            </form>

        </div>

    </body>

    </html>

<?php
}
?>