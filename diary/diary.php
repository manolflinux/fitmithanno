<?php
include('../workouts/navbarWod.php');
// include('jumbotron.php');
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title> Trainingstagebuch - Überblick</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fahkwang:wght@200&display=swap" rel="stylesheet">
</head>

<body>

    <div class=" container my-5 z-depth-1 rounded border">
        <!--Section: Content-->
        <section class="dark-grey-text">

            <div>
                <!-- <div class="col-md-7 mb-4">

                    <div class="view">
                        <img src='./images/hanno.JPG' alt="hanno" style="width: 475px; height: 564px" class="img-fluid rounded">
                    </div>

                </div> -->
                <div>
                    <div>

                        <h3 class="font-weight-bold mb-4"> Dein Trainingstagebuch!</i> </h3>

                        <br>
                        <p>Behalte den Überblick über deine sportlichen Aktivitäten </p>
                        <h3>Workouts speichern</h3>
                        <p>Du hast Zugriff auf alle Workouts der Datenbank. Wenn du dich entschließt, eines zu machen, wird nach Betätigen des Buttons "Workout absolviert" ein Popup geöffnet. <br> Hier hast du die Möglichkeit, dein Training vor dem Speichern zu ergänzen:
                            <br> Zeitdauer ergänzen: <br>
                            <strong> Wie lange </strong> hast du gebraucht bzw.<br> <strong> wie viele Wiederholungen </strong> hast du geschafft?
                            <br><strong>Wie viel Gewicht</strong> hast du genommen?
                            <br> Du hast außerdem noch die Möglichkeit, Notizen zum Workout einzutragen.
                        </p>

                        <h3>Tagebuch ansehen und bearbeiten</h3>
                        <p>unter "Mein Trainingstagebuch" kannst du alle gespeicherten Workouts ansehen und auch nachträglich bearbeiten und ergänzen </p>

                        <h3>Workout wiederholen</h3>
                        <p>Außerdem hast du die Möglichkeit, mit einem Klick auf "Training erneut absolvieren" in den Workoutmodus zu kommen</p>

                        <h3>Trainingstagebuch teilen</h3>
                        <p>du möchtest gerne jemandem dein Tagebuch zeigen? <br> kein Problem: mit einem Klick auf "Tagebuch teilen" erstellst du einen Link, der von einem Freund, einer Freundin, deinem Personal Trainer etc, sehenden Zugriff auf dein Tagebuch erlaubt. <br><br> Es ist allerdings nur dir selbst möglich, dein Tagebuch zu bearbeiten.</p>





                    </div>
                </div>
            </div>

        </section>
        <!--Section: Content-->
    </div>


    <!-- <div class="container-warning">
        <section>

            <div>
                <img id="licht" src="./img/lichterkette.png" alt="radschlagender Hanno">
            </div>

        </section>
    </div> -->


    <?php include('../footer.php'); ?>


</body>

</html>