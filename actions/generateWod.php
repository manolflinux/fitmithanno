<?php
ob_start();
session_start();
require_once '../config.php';

include('../workouts/navbarWod.php');
include('funktionen.php');


if ($_POST) {

    $difficulty = $_POST['difficulty'];
    $durationInMinutes = $_POST['durationInMinutes'];
    $userId = $_SESSION['user'];

    //old: single select
    // $equiSetId = $_POST['equipment'];

    //new: multiselect
    $equiSetId = "";

    // Check if any option is selected 
    if (isset($_POST["equipment"])) {

        // Retrieving each selected option 
        foreach ($_POST['equipment'] as $equipment)
            //print "You selected $equipment<br/>";
            $equiSetId .= $equipment . ",";
    } else {
        echo "Bitte Equipment auswählen!";
    }

    $equiSetId = " in (" . substr_replace($equiSetId, "", -1) . ")";


    $sql = "SELECT wod.*, AVG(rating) as 'rating' FROM wod
    left join rating on rating.wodId = wod.wodId
    inner join equSet on wod.equiSetId = equSet.equiSetId
    WHERE difficulty $difficulty 
    and (wod.equiSetId $equiSetId
    or equiPart1 $equiSetId
    or equiPart2 $equiSetId
    or equiPart3 $equiSetId )
    and durationInMinutes $durationInMinutes
    GROUP BY wod.wodId
    limit 15
    ";

    $result = $conn->query($sql);
    $count = mysqli_num_rows($result);

?>


    <div class="container_genwod">

        <?php

        if ($count >= 1) {

            while ($fetch = mysqli_fetch_array($result)) {

                $wodId = $fetch['wodId'];
                $name = $fetch['wodName'];
                $equipment = $fetch['equipment'];
                $equiSetId = $fetch['equiSetId'];
                $trainedParts = $fetch['trainedParts'];
                $description = $fetch['description'];
                $durationInMinutes = $fetch['durationInMinutes'];
                $difficulty = $fetch['difficulty'];
                $link = $fetch['link'];
                $rating = $fetch['rating'];

                if ($rating == "") {
                    $rating = 0.001;
                }
                $cat = getBGColor($difficulty);
                $picData = getPictureData($equiSetId);
                $pic = $picData[0];
                $pic_style = $picData[1];
                $stars = getStars($rating);



        ?>


                <div class="card m-2 text-center" style="width:300px">
                    <img class="card-img-top mx-auto" src=<?php echo $pic; ?> alt="category image" style="<?php echo $pic_style; ?>">
                    <div class="card-body" style="background-color: <?php echo $cat; ?> ">
                        <h4 class="card-title text-dark"><?php echo $name; ?></h4>
                        <p class="card-text">Dauer: <?php echo $durationInMinutes; ?> Minuten</p>
                        <p class="card-text">Kategorie: <?php echo $difficulty; ?></p>
                        <h2><?php echo $stars; ?></h2>
                        <!-- <p><#?php echo $rating; ?> </p> -->
                        <a href="../workouts/wodDetail.php?wodId=<?php echo $wodId; ?>" class="btn button_bee"> Zum Workout</a>

                    </div>
                </div>

            <?php

                // $conn->close();
            }
        } else {

            ?>
            <div class="text-center mx-auto mt-4 mb-4 p-4 rounded" style="border: 1pt solid var(--clr-header);">
                <h3>Oh nein!! </h3><br>

                <img src="../images/rudolf_error.png" style="width:338px; height:166px;">
                <h5>Es sieht so aus, als gäbe es kein Wod für deine gewünschte Auswahl..</h5>
                <h5 class="mt-3"><strong>Bitte probier folgendes:</strong>
                    <ul class="mt-3">
                        <h5>Ändere die Kategorie: trau dich! </h5>
                        <h5>Darfs ein bisserl mehr/weniger sein: Ändere die Workout-Minuten! </h5>
                        <h5>Probier neues Equipment aus!</h5>
                    </ul>
                    <a href='../workouts/wod.php' class='btn button_bee mt-3 mb-3'> Ok, ich versuchs nochmal! </a>

                </h5>
                <!-- header("refresh:2; ../workouts/wod.php"); -->

            </div>




        <?php
        }
        // else {
        //     echo "oh nein!! <br>es sieht so aus, als gäbe es kein Wod für deine gewünschte Auswahl..";
        //     header("Location: wod.php");
        // }

        ?>

    </div>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Welcome - <?php echo $userRow['userEmail']; ?></title>
        <link rel="stylesheet" href="../style.css">
    </head>

    <body style="background: white">




    <?php


    // Free result set
    mysqli_free_result($result);
    // Close connection
    mysqli_close($conn);
}
    ?>


    <script>
        var x = document.getElementById('workout');
        x.setAttribute("tabindex", 1);
        x.focus()
    </script>

    </body>

    </html>