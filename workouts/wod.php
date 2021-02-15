<?php
ob_start();
session_start();

require_once '../config.php';

if (isset($_SESSION["user"])) {
    $res = mysqli_query($conn, "SELECT * FROM users WHERE userId=" . $_SESSION['user']);
    $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
}

if (isset($_SESSION['access_token'])) {
    $res = mysqli_query($conn, "SELECT * FROM users WHERE oauth_uid=" . $_SESSION['id']);
    $count = mysqli_num_rows($res);

    $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
}

include('navbarWod.php');


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title> Workouts - Überblick</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fahkwang:wght@200&display=swap" rel="stylesheet">
</head>

<body>

    <!-- <div class="container my-5 z-depth-1 rounded border"> -->
    <div class="container rounded border">
        <!--Section: Content-->
        <section class="dark-grey-text">

            <div>

                <div>
                    <div>

                        <h3 class="font-weight-bold mb-4 mt-4"> Nun wird es sportlich..</i> </h3>

                        <br>
                        <p>Was kannst du alles machen? </p>
                        <h3>Workout wählen</h3>
                        <p>Du hast Zugriff auf alle Workouts der Datenbank. Du kannst nach folgenden Kriterien filtern: </p>


                        <li> <strong>Zeitdauer:</strong> Hier ist alles möglich zwischen extrakurz und zeitfüllend</li>
                        <li> <strong>Level</strong> Hier gibt es die Kategorien <strong style="background-color: var(--clr-easy)">easy</strong> , <strong style="background-color: var(--clr-medium)">intermediate</strong>, <strong style="background-color: var(--clr-hard)">hard</strong> und <strong style="background-color: var(--clr-cf)">crossfit</strong>, achte hierbei auf die unterschiedliche Farbe!</li>
                        <li> <strong>Equipment</strong> Du hast Lust auf ein bestimmtes Trainingsgerät wie Kettlebell, Hantel, Springschnur, etc..? Hier kannst du danach suchen - Mehrfachselektion mit STR-Shift ist möglich</li>
                        <li> <strong>zusätzliche Filter</strong> Du möchtest nach Workouts eines bestimmten Members oder nach Workoutnamen filtern?</li>
                        <li> <strong>Zu faul zum Suchen?</strong> Ja - auch für dich haben wir etwas: Starte mit nur einem Klick zu deinem Überraschungsworkout! </li>
                        </ul>

                        <br><br>

                        <div class="container_wod">

                            <div class="wod_left p-2">

                                <form action="../actions/generateWod.php" method='post'>
                                    <h3 class="pb-3"> <br>Workout suchen </h3>

                                    <div class="form-group">
                                        <h5 class="pb-1">LEVEL:</h5>
                                        <select name='difficulty' id='level'>
                                            <option> -- Level --- </option>
                                            <option value='in (1,2,3,4)' name='difficulty' class='form-control' selected> egal</option>
                                            <option value=' = 1' name='difficulty' class='form-control'> easy</option>
                                            <option value='=2' name='difficulty' class='form-control'> intermediate</option>
                                            <option value='=3' name='difficulty' class='form-control'> hard</option>
                                            <option value='=4' name='difficulty' class='form-control'> crossfit</option>
                                            <!-- <option value='=5' name='difficulty' class='form-control'> hanni</option> -->
                                        </select>



                                        <h5 class="pt-3 pb-1 mt-3">DURATION:</h5>
                                        <!-- <input type='text' name='durationInMinutes' placeholder='max Dauer in min' /></h5> -->

                                        <!-- Default inline 4-->
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="defaultInline4" name="durationInMinutes" value="< 300 " checked>
                                            <label class="custom-control-label" for="defaultInline4"> egal</label>
                                        </div>

                                        <!-- Default inline 5-->
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="defaultInline5" name="durationInMinutes" value="<= 5">
                                            <label class="custom-control-label" for="defaultInline5"> bis 5 min</label>
                                        </div>

                                        <!-- Default inline 1-->
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="defaultInline1" name="durationInMinutes" value=" <=10">
                                            <label class="custom-control-label" for="defaultInline1">
                                                bis 10 min</label>
                                        </div>



                                        <!-- Default inline 2-->
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="defaultInline2" name="durationInMinutes" value="between 11 and 20">
                                            <label class="custom-control-label" for="defaultInline2"> 10 - 20 min</label>
                                        </div>

                                        <!-- Default inline 3-->
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="defaultInline3" name="durationInMinutes" value="between 21 and 30 ">
                                            <label class="custom-control-label" for="defaultInline3"> > 21 - 30 min</label>
                                        </div>

                                        <!-- Default inline 6-->
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="defaultInline6" name="durationInMinutes" value="between 31 and 299 ">
                                            <label class="custom-control-label" for="defaultInline6"> > 30 min</label>
                                        </div>

                                        <!-- [Part equipment start] -->


                                        <div class="container-equipment">
                                            <h5 class="pt-3 pb-1 mt-3">EQUIPMENT:</h5>
                                            <select multiple='multiple' class='mb-4' name='equipment[]' style="width:90%;">

                                                <?php

                                                $sql2 = "SELECT equSet.equiSetId, e1.equipmentName as equiPart1, equSet.equiPart2,'',''
                    FROM equSet
                    inner join equipment e1 on equSet.equiPart1 = e1.equipmentId
                    WHERE  ! COALESCE(equiPart2,'')
                    UNION 
                    SELECT equSet.equiSetId, e1.equipmentName as equiPart1,  e2.equipmentName as equiPart2, '',''
                    from equSet
                    inner join equipment e1 on equSet.equiPart1 = e1.equipmentId
                    inner join equipment e2 on equSet.equiPart2 = e2.equipmentId
                    WHERE  ! COALESCE(equiPart3,'')
                    UNION 
                    SELECT equSet.equiSetId, e1.equipmentName as equiPart1,  e2.equipmentName as equiPart2, e3.equipmentName as equiPart3,''
                    from equSet
                    inner join equipment e1 on equSet.equiPart1 = e1.equipmentId
                    inner join equipment e2 on equSet.equiPart2 = e2.equipmentId
                    inner join equipment e3 on equSet.equiPart3 = e3.equipmentId  
                    WHERE  ! COALESCE(equiPart4,'')
                    UNION 
                    SELECT equSet.equiSetId, e1.equipmentName as equiPart1,  e2.equipmentName as equiPart2, e3.equipmentName as equiPart3,  e4.equipmentName as equiPart4
                    from equSet
                    inner join equipment e1 on equSet.equiPart1 = e1.equipmentId
                    inner join equipment e2 on equSet.equiPart2 = e2.equipmentId
                    inner join equipment e3 on equSet.equiPart3 = e3.equipmentId
                    inner join equipment e4 on equSet.equiPart4 = e4.equipmentId
                    WHERE  ! COALESCE(equiPart5,'')
                    ORDER BY `equiSetId` ASC limit 10";


                                                $result2 = mysqli_query($conn, $sql2);
                                                $count = mysqli_num_rows($result2);

                                                // echo "<option> ----Equipment wählen ----- </option>";
                                                while ($row = mysqli_fetch_array($result2)) {

                                                    echo $equiSetId = $row['equiSetId'];
                                                    echo $e1 = $row['equiPart1'];
                                                    $e2 = $row['equiPart2'];
                                                    $e3 = $row['equiPart3'];
                                                    $e4 = $row['equiPart4'];



                                                    if ($equiSetId == 1) {
                                                        $checked = 'selected';
                                                    } else {
                                                        $checked = '';
                                                    }


                                                    //echo "<option> $row[authorID] $row['firstname'] | $row ['lastname']</option>";
                                                    echo "<option value= $equiSetId $checked name= 'equipment' class='form-control'> $equiSetId $e1 $e2 $e3 $e4</option>";
                                                }
                                                echo "</select>";

                                                ?>
                                            </select>


                                            <!-- [Part equipment end] -->

                                            <!-- <p>test: id: <#?php echo $equiSetId ?></p>
                                            <p>test: e1: <#?php echo $e1 ?></p> -->


                                            <!-- <input type="hidden" name="dayId" value="<?php echo $data['dayId'] ?>" /> -->
                                            <!-- <p><#?php echo $data['dayId'] ?></p> -->

                                            <input class="button_bee form-control mt-4" type="submit" name="submit" value="Workout suchen" style="width:90%;" />
                                            <!-- 
                                    <a href="home.php" class="btn btn-outline-warning">Zurück</a> -->
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div class="wod_right p-2">
                                <br><br><br>
                                <h3 class="mt-2">Andere Filterkriterien</h3>
                                <br>
                                <!-- <input type="text" placeholder="Name des Wods" name="name" class="form-control"><br> -->
                                <input class="form-control button_bee" type="submit" name="submit" value="Nach Workout-Namen suchen" />

                                <input type="text" placeholder="Name des Wods" name="name" class="form-control" onkeyup="searchForWodName(this.value);">


                                <hr>
                                <input class="form-control button_bee" type="submit" name="submit" value="nach User-Namen suchen" />
                                <input type="text" placeholder="Name Mitglied" name="userName" class="form-control" onkeyup="searchForUserName(this.value);"><br>

                                <hr>

                                <?php


                                $res3 = mysqli_query($conn, "SELECT MAX(wodId) FROM wod");
                                $userRow = mysqli_fetch_array($res3, MYSQLI_ASSOC);

                                $maxWod = $userRow['MAX(wodId)'];

                                $maxWod = rand(1, $maxWod);

                                ?>

                                <a href="../workouts/wodDetail.php?wodId=<?php echo $maxWod; ?>" class="form-control button_bee mt-4"> Überrascht mich!</a>


                            </div>
                        </div>


                        <div id="ergebnis"></div>

                        <hr>
                        <p>Als eingeloggte/r User/in kannst du übrigens unter <strong class="p-2" style="background-color: var(--clr-header)">myHanno</strong> noch folgende Features nutzen:</p>

                        <h6>Absolvierte Workouts in deinen eigenen <strong>Workoutkalender</strong> speichern</h6>
                        <p>Damit hast du einen guten Überblick über deine Sportlichkeit!</p>

                        <strong>Eigene Workouts erstellen</strong>
                        <p>Hier kannst du deine eigenen Workouts eintragen und speichern!</p>

                        <!-- <strong> Ranglisten erstellen, Matching mit FreundInnen</strong>

                        <p>Fordere deine FreundInnen heraus, ein Workout zu absolvieren!</p>
                        <p>Teile deinen Kalender mit ihnen, um sie anzuspornen! </p> -->

                        <strong>Workouts raten</strong>
                        <p>Hier kannst du Feedback geben, wie dir ein Workout gefallen hat:

                        <h4>Verteile Sterne:</h4>
                        <ul>

                            <li> <strong>5 Sterne:</strong> Mein neues Lieblingsworkout!</li>
                            <li> <strong>4 Sterne:</strong> gefällt mir!</li>
                            <li> <strong>3 Sterne:</strong> okay</li>
                            <li> <strong>2 Sterne:</strong> nicht so ganz meins..</li>
                            <li> <strong>1 Stern:</strong> NEVER AGAIN!</li>
                        </ul>

                        Außerdem hast du noch ein Feedbackfeld, um genau anzubringen, was dir gefällt bzw nicht gefällt:
                        War es zu anstrengend? <br>
                        Passt es besser in eine andere Kategorie? <br>

                        </p>


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

    <script type="text/javascript">
        function searchForWodName(suchbegriff) {
            var xmlHttp = null;
            // Mozilla, Opera, Safari sowie Internet Explorer 7
            if (typeof XMLHttpRequest != 'undefined') {
                xmlHttp = new XMLHttpRequest();
            }
            if (!xmlHttp) {
                // Internet Explorer 6 und älter
                try {
                    xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {
                        xmlHttp = null;
                    }
                }
            }
            // Wenn das Objekt erfolgreich erzeugt wurde			
            if (xmlHttp) {
                var url = "../actions/ajaxSucheWodName.php";
                var params = "suchbegriff=" + suchbegriff;

                xmlHttp.open("POST", url, true);

                //Headerinformationen für den POST Request
                xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlHttp.setRequestHeader("Content-length", params.length);
                xmlHttp.setRequestHeader("Connection", "close");

                xmlHttp.onreadystatechange = function() {
                    if (xmlHttp.readyState == 4) {
                        // Zurückgeliefertes Ergebnis wird in den DIV "ergebnis" geschrieben
                        document.getElementById("ergebnis").innerHTML = xmlHttp.responseText;
                    }
                };
                xmlHttp.send(params);
            }
        }

        function searchForUserName(suchbegriff) {
            var xmlHttp = null;
            // Mozilla, Opera, Safari sowie Internet Explorer 7
            if (typeof XMLHttpRequest != 'undefined') {
                xmlHttp = new XMLHttpRequest();
            }
            if (!xmlHttp) {
                // Internet Explorer 6 und älter
                try {
                    xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {
                        xmlHttp = null;
                    }
                }
            }
            // Wenn das Objekt erfolgreich erzeugt wurde			
            if (xmlHttp) {
                var url = "../actions/ajaxSucheUserName.php";
                var params = "suchbegriff=" + suchbegriff;

                xmlHttp.open("POST", url, true);

                //Headerinformationen für den POST Request
                xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlHttp.setRequestHeader("Content-length", params.length);
                xmlHttp.setRequestHeader("Connection", "close");

                xmlHttp.onreadystatechange = function() {
                    if (xmlHttp.readyState == 4) {
                        // Zurückgeliefertes Ergebnis wird in den DIV "ergebnis" geschrieben
                        document.getElementById("ergebnis").innerHTML = xmlHttp.responseText;
                    }
                };
                xmlHttp.send(params);
            }
        }
    </script>

</body>

</html>