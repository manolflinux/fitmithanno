<?php
require_once './config.php';
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
    <title>Impressum</title>
</head>


<body>

    <div class="container-warning mt-5 mb-5">
        <section class="warning2">

            Bei vorliegener Webseite handelt es sich um keine kommerzielle Website - wir sind daher nicht von der Impressionspflicht betroffen.
            <br>

            <h4 class="mt-3"><strong> Informationspflichten nach der Datenschutz-Grundverordnung (DSGVO)</strong></h4>
            <h4>
                <strong> Datenschutzerklärung nach dem Telekommunikationsgesetz (TKG)</strong>
            </h4>
            <br>


            Es werden ausschließlich technisch notwendige Cookies (wie zum Beispiel für das Sign-In with Google) gespeichert.
            <br>
            Sämtliche Daten welche im Rahmen der Registrierung auf der Site angegeben werden, werden ausschließlich zu Zuordnungszwecken verwendet und nicht an Dritte weitergegeben.
            <br>

            <h4 class="mt-4"><strong>Urheberrecht</strong></h4>
            Alle Texte, Fotos und grafischen Gestaltungen auf dieser Internetpräsenz sind urheberrechtlich geschützt und dürfen nicht ohne unsere Einwilligung übernommen und verwendet werden.



        </section>
    </div>
    <?php
    include('footer.php');
    ?>

</body>

</html>