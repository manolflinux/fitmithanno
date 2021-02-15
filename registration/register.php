<?php
ob_start();
session_start(); // start a new session or continues the previous
include('../workouts/navbarWod.php');
if (isset($_SESSION['user']) != "") {
    header("Location: ./home.php"); // redirects to home.php
}
if (isset($_SESSION['admin']) != "") {
    header("Location: admin.php"); // redirects to home.php
}
if (isset($_SESSION['superadmin']) != "") {
    header("Location: superadmin.php"); // redirects to home.php
}
include_once '../config.php';

$error = false;
if (isset($_POST['btn-signup'])) {

    // sanitize user input to prevent sql injection
    $name = trim($_POST['name']);

    //trim - strips whitespace (or other characters) from the beginning and end of a string
    $name = strip_tags($name);

    // strip_tags — strips HTML and PHP tags from a string

    $name = htmlspecialchars($name);
    // htmlspecialchars converts special characters to HTML entities
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    // basic name validation
    if (empty($name)) {
        $error = true;
        $nameError = "Please enter your full name. Bitte vollständigen Namen eintragen";
    } else if (strlen($name) < 3) {
        $error = true;
        $nameError = "Name must have at least 3 characters. Mindestens 3 Buchstaben!";
    } else if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $error = true;
        $nameError = "Name must contain alphabets and space. Nur Buchstaben und Leerzeichen erlaubt!";
    }

    //basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address. <br> Bitte gültige Emailadresse eintragen";
    } else {
        // checks whether the email exists or not
        $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            $error = true;
            $emailError = "Provided Email is already in use. <br> Emailadresse bereits im System. ";
        }
    }
    // password validation
    if (empty($pass)) {
        $error = true;
        $passError = "Please enter password. <br> Passwort eintragen";
    } else if (strlen($pass) < 6) {
        $error = true;
        $passError = "Password must have at least 6 characters. <br> Passwort muss mindestens 6 Zeichen lang sein.";
    }

    // password hashing for security
    $password = hash('sha256', $pass);


    // if there's no error, continue to signup
    if (!$error) {

        $query = "INSERT INTO users(userName,userEmail,userPass, created ) VALUES('$name','$email','$password', now() )";
        $res = mysqli_query($conn, $query);


        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered, you may login now. <br> Bitte einloggen!";
            unset($name);
            unset($email);
            unset($pass);
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later... <br> Fehler: bitte später nochmals probieren!";
        }
    }
}
$loginURL = $gClient->createAuthUrl();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login & Registration System</title>
    <meta http-equiv="Content-Type" charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

</head>

<body>

    <div class="container_login ml-3 mr-3 mb-5 " style="margin-top: 100px">
        <div class="row justify-content-center">
            <div class="col-md-6 col-offset-3" align="center">

                <img src="../images/logo_colored.png" style="width:300px; height:300px;"><br><br>


                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">


                    <h2 class="text-header">Sign Up.</h2>
                    <hr />

                    <?php
                    if (isset($errMSG)) {

                    ?>
                        <div class="alert alert-<?php echo $errTyp ?>">
                            <?php echo  $errMSG; ?>
                        </div>

                    <?php
                    }
                    ?>




                    <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" />

                    <span class="text-danger"> <?php echo  $nameError; ?> </span>



                    <input type="email" name="email" class="form-control mt-2 mb-2" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />

                    <span class="text-danger"> <?php echo  $emailError; ?> </span>





                    <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />

                    <span class="text-danger"> <?php echo  $passError; ?> </span>

                    <hr />


                    <button type="submit" class="btn" name="btn-signup" style="background-color: black; color: rgb(255, 196, 0);">Sign Up</button>
                    <input type="button" onclick="window.location = '<?php echo $loginURL ?>';" value="Log In With Google" class="btn" style="background-color: black; color: rgb(255, 196, 0);">
                    <hr />

                    <a href="login.php">Log in Here...</a>


                </form>


            </div>

        </div>

    </div>

    <?php
    include('../footer.php');
    ?>


</body>

</html>
<?php ob_end_flush(); ?>