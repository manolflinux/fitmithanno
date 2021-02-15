<?php
ob_start();
session_start();
require_once '../config.php';
$previousPage = $_SERVER['HTTP_REFERER'];

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
include('../workouts/navbarWod.php');



if ($_POST) {

    $wodId = $_POST['wodId'];
    $comment = $_POST['comment'];

    $sql = "INSERT into kalender (wodId, userId, comment)  values ('$wodId', '$userId', '$comment')";

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../style.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <title>Workout in Kalender eintragen</title>
    </head>

    <body>




        <?php


        if ($conn->query($sql) === TRUE) {
            echo "<div class= 'text-dark pt-2 pb-2'>";
            echo "<p><center><b> Das Workout wurde in deinen Kalender eingetragen</b></center></p>";


            $sql2 = "SELECT * from kalender inner join rating on rating.wodId = kalender.wodId WHERE rating.userId = $userId and kalender.wodId = $wodId";

            $result = $conn->query($sql2);
            //$data = $result->fetch_assoc();
            $count = mysqli_num_rows($result);

            if ($count == 0) {


        ?>

                <div class="wrapper_rating">

                    <p>
                        <center>Hier kannst du einmalig das absolvierte Workout bewerten.</center>
                        <center> Dies dient anderen NutzerInnen zur Orientierung und den Elfen als Feedback!</center>
                    </p>
                    <form action="rating2.php" method="post">
                        <div class="container_rating">
                            <div class="rating_left">
                                <fieldset class="rating ml-4">
                                    <legend>Dein Workout-Rating</legend>
                                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Super! Mein neues Lieblingsworkout!">5 stars</label>
                                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Sehr gut!">4 stars</label>
                                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="OK">3 stars</label>
                                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Nicht so gut">2 stars</label>
                                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Fürchterlich">1 star</label>
                                </fieldset>
                            </div>

                            <div class="rating_right">

                                <fieldset class="freitext">
                                    <legend class="ml-4">Zusätzliche Anmerkungen</legend>
                                    <textarea name="anmerkung" class="md-textarea form-control" rows="3"></textarea>
                                </fieldset>
                            </div>
                        </div>

                        <input type="hidden" name="wodId" value="<?php echo $wodId; ?>" />
                        <!-- <input type="hidden" name="userId" value="<#?php echo $userId; ?>" /> -->

                        <div class="text-center mt-3 mb-3">
                            <button class="btn button_bee" type=submit> Rating abschicken</button>
                            <a class='btn button_bee m-2' href='../home.php'>Abbrechen</a>

                        </div>
                    </form>

                </div>

    <?php

                echo "</div>";
            } else {
                echo "<h2 class='text-center'>Super Leistung! Bleib dran!</h2>";

                header("refresh:2; url=../home.php");
            }
        } else {

            echo "Error " . $sql . ' ' . $conn->connect_error;
        }
        $conn->close();
    }

    ?>

    </body>

    </html>