<?php
ob_start();
session_start();
require_once '../config.php';
include('../actions/funktionen.php');
//echo $previousPage = $_SERVER['HTTP_REFERER'];
//echo $previousPage = $_SERVER['REQUEST_URI'];

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

//NAVBAR
include('../workouts/navbarWod.php');


if ($_GET['wodId']) {
    $wodId = $_GET['wodId'];

    $sql = "SELECT wod.*, users.*, equset.*, AVG(rating) as 'rating' FROM wod 
    left join rating on rating.wodId = wod.wodId 
    inner join users on users.userId= wod.userId 
    inner join equset on wod.equiSetId = equset.equiSetId
    WHERE wod.wodId = $wodId 
    GROUP BY wod.wodId
    ";



    $result = $conn->query($sql);
    $data = $result->fetch_assoc();

    $cat = $data['difficulty'];
    $bgColor = getBGColor($cat);
    $gRating = $data['rating'];
    if ($gRating == "") {
        $gRating = 0.001;
    }
    $starG = getStars($gRating);
    $equiSetId = $data['equiSetId'];
    $picData = getPictureData($equiSetId);
    $picCol = $picData[3];
    $pic_style = $picData[1];



    $count = mysqli_num_rows($result);
    if ($count == 0) {
        // echo "oh nein...";
        "es sieht so aus, als gäbe es kein Wod mit dieser Id";
        header("Location: wod.php");
    }


    // $conn->close();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - <?php echo $userRow['userEmail']; ?></title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <script src="https://cdn.tiny.cloud/1/fyga9b2vms5na1vvgr2ey9wn6ms9d7ucfg44hszp3i61u8ll/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea2',
            placeholder: "zum Beispiel: Anzahl Wiederholungen, benötigte Zeit, Tagesverfassung.. "

        });
    </script>

</head>

<body ">

    <div class=" workoutwrapper mt-4">

    <div class=" top mx-auto">
        <h2 class="font-weight-bold pb-3 text-dark">Workoutdetails</h2>
    </div>
    <div class="container_single mx-auto">

        <div class="left" style="border: 1pt solid <?php echo $bgColor; ?>; border-radius: 2%;">
            <h3 class=" text-light" style="background-color:<?php echo $bgColor; ?>"> <span class="ml-4" style="background-color:<?php echo $bgColor; ?>"><?php echo $data['wodName'] ?></span></h3>
            <div class="ml-4 ">




                <hr>


                <h6 class='text-dark'>
                    <?php echo $data['description'] ?>

                </h6>

                <h6><a target="_blank" href=" <?php echo $data['link']; ?>"> Link zusätzliche Infos </a></h6>

                <!-- <#?php
                    if ($data['link'] != '') {
                        echo ('<strong>Zusätzliche Infos: </strong> <a href=' . $data['link'] . ' > </a>');
                    } else {
                        echo " ";
                    }
                    ?> -->

                <br>
                <h6><strong>Zeitaufwand:</strong> <?php echo $data['durationInMinutes'] ?> Minuten</h6>

                <h6> <strong>Trainierte Körperpartien:</strong> <br>
                    <?php echo $data['trainedParts'] ?>
                </h6>

                <h6>
                    zur Verfügung gestellt von <a href="<?php echo $data['insta'] ?>" target="_blank"><?php echo $data['userName'] ?></a>
                </h6>

                <hr>



            </div>
        </div>

        <div class="right">

            <div class="mx-auto ">



                <section class="dark-grey-text ">

                    <img class="card-img-top mx-auto" src=<?php echo $picCol; ?> alt="category image">

                    <!-- <div class="col-md-5 mb-4">
                        <div class="view">
                            <img src='../images/hanno.JPG' alt="elfPic" class="mt-4 rounded" style="width:300px;">
                        </div>
                    </div> -->








                </section>
            </div>
        </div>




    </div>

    <div class="bottom mx-auto">


        <h5 class="text-center">Aktuelles Rating: <?php echo $starG; ?></h5>
        <!-- <p><?php echo $data['rating'] ?></p> -->


        <?php

        $sql2 = "SELECT rating.*, users.userName, users.insta FROM wod 
                                inner join rating on rating.wodId = wod.wodId
                                inner join users on users.userId = rating.userId
                                WHERE wod.wodId = $wodId ORDER BY wod.wodId ASC";


        $result2 = $conn->query($sql2);

        $conn->close();

        $count = mysqli_num_rows($result2);
        if ($count == 0) {
            // echo "oh nein...";
            "es sieht so aus, als gäbe es noch kein Rating";
        }


        if ($count >= 1) {

            // echo "<h4 class='text-dark'>UserRatings</h4>";
            echo "<details class='text-dark font-weight-bold text-center mt-3'>";
            while ($fetch = mysqli_fetch_array($result2)) {


                $eRating = $fetch['rating'];
                $starE = getStars($eRating);
        ?>
                <hr>
                <p><?php echo $fetch['userName'] ?> : <?php echo $starE; ?> </p>

                <p><?php echo $fetch['ratingText'] ?></p>


        <?php
            }
            echo "</details>";
        }

        ?>

        <!-- <h4> WORKOUT</h4>
            <p>als eingeloggter User kannst du zusätzliche Notizen zum Workout abspeichern</p> -->


        <?php
        if (isset($_SESSION["user"]) || isset($_SESSION["access_token"])) {

        ?>
            <form action='rating.php' method='post'>

                <label for="description" class="mt-3 text-secondary"> Notizen zum Workout</label>
                <textarea class="form-control" id="mytextarea2" rows="3" name="comment" placeholder="Tagesverfassung, Anzahl Wiederholungen, benötigte Zeit.." style="background-color: 'white';"></textarea>

                <input type="hidden" name="wodId" value="<?php echo $data['wodId']; ?>" />

                <div class="d-flex justify-content mt-2 mb-2">
                    <input class="btn button_bee  mr-1" type='submit' name="submit" value="Speichern" style="width:50%;" />
                    <a class='btn button_bee text-center' style="width:50%;" href='../home.php'>Zurück</a>

                </div>

            </form>




        <?php
        } else {

            echo "<p class='mt-3 p-2 bg-light'> <span class='text-danger'><strong>Achtung!</strong> </span> Nur als <strong>eingeloggte/r User/in </strong> kannst du absolvierte Workouts mit Notizen in deinem Kalender speichern</p>";
            echo "<div class= 'd-flex justify-content-center'>";
            echo "<a class='btn button_bee m-2' href='../registration/login.php' >Zum Login</a> ";
            echo "<a class='btn button_bee m-2' href='wod.php' >Zurück</a> ";
            echo "</div>";
        }

        ?>

    </div>

    </div>
    <?php
    include('../footer.php');
    ?>

</body>

</html>