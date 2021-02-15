<?php

ob_start();
session_start();
require_once "../config.php";
include('../workouts/navbarWod.php');

if (isset($_SESSION['access_token'])) {
    echo "bereits mit Google eingeloggt";
    echo "<br>";
    echo $_SESSION['id'];
    echo "<br>";
    echo $_SESSION['givenName'] . " ";
    echo $_SESSION['familyName'];
    echo "<br>";
    echo $_SESSION['email'];
    echo "<br>";
    echo $userRow['userId'];
    echo "<a href='logout.php?logout'>Logout?</a>";
    //header('Location: home.php');
    exit();
}

if (isset($_SESSION['user']) != "") {
    echo "bereits eingeloggt";
    $res = mysqli_query($conn, "SELECT * FROM users WHERE userId=" . $_SESSION['user']);
    $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

    echo     "<h2> Welcome " .  $userRow['userName'] . "</h2>";

    //header("Location: ../home.php");
    echo "<a href='logout.php?logout'>Logout?</a>";
    echo ".. um sich mit anderem User einzuloggen?";
    exit;
}

$error = false;

if (isset($_POST['btn-login'])) {

    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    // prevent sql injections / clear user invalid inputs

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if (empty($pass)) {
        $error = true;
        $passError = "Please enter your password.";
    }

    // if there's no error, continue to login
    if (!$error) {

        $password = hash('sha256', $pass); // password hashing

        //old
        $res = mysqli_query($conn, "SELECT * FROM users WHERE userEmail='$email'");
        //$obj->read('users',array('useremail'=>$email));


        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        $count = mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row

        if ($count == 1 && $row['userPass'] == $password) {
            if ($row["status"] == 'admin') {
                $_SESSION["admin"] = $row["userId"];
                header("Location: ../admin/admin.php");
            } elseif ($row["status"] == 'superadmin') {
                $_SESSION['superadmin'] = $row['userId'];
                header("Location: ../admin/admin.php");
            } else {
                $_SESSION['user'] = $row['userId'];
                header("Location: ../home.php");
            }
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
        }
    }
}


$loginURL = $gClient->createAuthUrl();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login @ FitMitHanno.fun</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>

    <div class="container_login ml-3 mr-3 mb-3 " style="margin-top: 100px">
        <div class="row justify-content-center">
            <div class="col-md-6 col-offset-3" align="center">

                <img src="../images/vector_logo_color.svg" style="width:300px; height:300px;"><br><br>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                    <input type="email" placeholder="Email..." name="email" class="form-control" value="<?php echo $email; ?>" maxlength="40"><br>
                    <input type="password" placeholder="Passwort..." name="pass" class="form-control" maxlength="25"><br>
                    <span class="text-danger"><?php echo $passError; ?></span>
                    <hr />
                    <input type="submit" value="Log In" class="btn" name="btn-login" style="background-color: black; color: rgb(255, 196, 0);">
                    <input type="button" onclick="window.location = '<?php echo $loginURL ?>';" value="Log In with Google" class="btn" style="background-color: black; color: rgb(255, 196, 0);">

                    <hr>
                    <div align="left"> <a href="register.php">Registrieren... </a></div>

                </form>

            </div>
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <?php
    include('../footer.php');
    ?>


</body>

</html>