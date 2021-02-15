<?php


ob_start();
session_start();
echo "test4";
require_once 'config.php';

if (isset($_SESSION["user"])) {
    $res = mysqli_query($conn, "SELECT * FROM users WHERE userId=" . $_SESSION['user']);
    $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
}

if (isset($_SESSION['access_token'])) {
    $res = mysqli_query($conn, "SELECT * FROM users WHERE oauth_uid=" . $_SESSION['id']);
    $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
}

include('navbar.php');

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title> Fit mit Hanno - mit Elfenpower durchs Jahr</title>
    <meta name="copyright" content="Manuela Thamer, Orsolya Veres">
    <meta name="description" content="Der Trainingskalender mit individuellen Workouts je nach Fitnesslevel, Tagesverfassung und Zeitaufwand begleitet von Elf Hanno und Rentier Rudolf">
    <meta name="keywords" content="fitmithanno fitmithanno.fun workout kalender wodgenerator Elf Hanno">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

    <div class=" container my-5 z-depth-1 rounded border">
        <!--Section: Content-->
        <section class="dark-grey-text">

            <div class="row pr-lg-5">
                <div class="col-md-7 mb-4">

                    <div class="view">
                        <img src='./images/rubi_colored.gif' alt="hanno" style="width: 475px; height: 564px" class="img-fluid rounded">
                    </div>

                </div>
                <div class="col-md-5 d-flex align-items-center mb-4">
                    <div>

                        <h3 class="font-weight-bold mb-4"> Willkommen...</i> </h3>



                        <p><strong>..mit viel Schwung geht es weiter! </strong><br><br> Wir platzen vor Stolz: du befindest dich auf unserer brandneuen Homepage mit vielen neuen Extras, die dir dabei helfen sollen, deine Sportlichkeit zu unterstützen, zu dokumentieren und zu zelebrieren!
                            <!-- <ul>
                            <li> <a href="./workouts/wod.php">Workoutgenerator</a></li>
                        </ul> -->
                            <br><br>
                            Für eingeloggte UserInnen gibts außerdem ein
                            Trainingstagebuch, die Möglichkeit, eigene Workouts zu erstellen und andere Workouts zu bewerten/raten. <br><br>
                            Mit dabei ist natürlich wieder unser Held <strong>Hanno</strong>, der nun seiner neuen Leidenschaft auch unterm Jahr frönen will - mit dem einzigartigen<strong> Rudi</strong> als Trainer an seiner Seite!


                            <br><br><strong>Nun aber auf zu großen Taten!</strong> <br>Weil: nach Weihnachten ist vor Weihnachten!


                    </div>
                </div>
            </div>

        </section>
    </div>



    <?php
    include('footer.php');
    ?>


</body>

</html>