<?php
require_once 'config.php';

// include('jumbotron.php');

ob_start();
session_start();

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
    <link rel="stylesheet" href="style.css">
    <title>Team</title>
    <link href="https://fonts.googleapis.com/css2?family=Fahkwang:wght@200&display=swap" rel="stylesheet">
</head>

<body>

    <br>
    <br>
    <br>

    <div class="container-secret ">

        <!-- <section class="secret pr-5 pl-5 mb-5">

            <h2 class="header-warn mb-4 mt-4">Nun lüften wir es, das Geheimnis...</h2>
            <h5 class="text-warn">Bestimmt hast du dich gefragt, wer diese hellen, klugen, motivierten, kreativen und geschickten Köpfe sind, welche mit Elfen- und Rentierpower unaufhaltsam dem Ziel entgegenstreben, dich fit bis zum Christbaum zu bringen, oder?
                <hr>
                Im Ernst: wir sind mit Spaß dabei und hoffen, wir können/konnten dir mit Hanno und seinen GefährtInnen den Advent etwas versüßen.
                <br> Lass es uns wissen, sag uns, ob wir unser Ziel erreicht haben! Du kannst uns unter <a href="contact.php">Kontakt</a> eine Nachricht zukommen lassen!
            </h5>

        </section> -->
    </div>

    <div class="container-team">

        <div class="col-lg-6 col-md-12 mb-5 d-md-flex justify-content-around">
            <div class="avatar mb-md-0 mb-4 mx-4">
                <br><br><br>
                <img src="./images/manu_stencil.svg" class="rounded z-depth-1" alt="manu pic" style="width:256px;height:384px">
            </div>
            <div class="mx-4">
                <h4 class="font-weight-bold mb-3 header-foto">FRONT- & BACKEND CODING</h4>
                <h6 class="font-weight-bold grey-text mb-3">manuela thamer</h6>
                <!-- <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic
                    tenetur.</p> -->

                <a class="p-2 fa-lg tw-ic" href="https://www.linkedin.com/in/manuela-thamer-0461231b8/">
                    <i class="fa fa-linkedin" style="color: var(--clr-header) "> </i>
                </a>

                <a class="p-2 fa-lg dribbble-ic" href="https://www.instagram.com/manoviews/" target="_blank">
                    <i class="fa fa-instagram" style="color: var(--clr-header)"> </i>
                </a>
            </div>
        </div>


        <div class="col-lg-6 col-md-12 mb-5 d-md-flex justify-content-around">

            <div class="avatar mb-md-0 mb-4 mx-4">
                <br><br><br>
                <img src="./images/orsi_stencil_V2.svg" class="rounded z-depth-1" alt="pic orsi" style="width:256px;height:384px" target="_blank">
            </div>
            <div class="mx-4">
                <h4 class="header-foto font-weight-bold">GRAPHICS AND ILLUSTRATIONS</h4>

                <h6 class="font-weight-bold grey-text">orsolya veres</h6>
                <!-- <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic
                    tenetur.</p> -->

                <a href="https://www.linkedin.com/in/orsolyaveres/" class="p-2 fa-lg tw-ic" target="_blank">
                    <i class="fa fa-linkedin" style="color: var(--clr-header)"> </i>
                </a>

                <a href="https://www.instagram.com/orsi_ov/" target="_blank" class="p-2 fa-lg dribbble-ic">
                    <i class="fa fa-instagram" style="color: var(--clr-header)"> </i>
                </a>
            </div>
        </div>


    </div>


    <!-- <div class="container-secret ">
        <section class="secret pr-5 pl-5 mb-5">

            <h2 class="header-warn mb-4 mt-4">Aber...</h2>
            <h5 class="text-warn">natürlich haben wir noch mehrere HelferInnen am Start, welche uns brav mit ihren Lieblingsworkouts versorgen. Nach jedem einzelnen Workout ist angegeben, wer dir dieses Geschenk gemacht hat!
                <br> Dank gebührt vor allem unseren ersten Supporterinnen: ein gröhlendes HOHOHO an <a href="	
https://www.instagram.com/babra_ann/" target="_blank">Babsi</a>, <a href="https://www.instagram.com/carmenkulterer" target="_blank">Carmen </a> und <a href="https://www.instagram.com/claudia.zazz/" target="_blank">Claudia!</a>
            </h5>

        </section>
    </div> -->



    <?php
    include('footer.php');
    ?>


</body>

</html>