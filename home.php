<?php
ob_start();
session_start();
require_once 'config.php';
include('actions/funktionen.php');

$currentPage = substr($_SERVER['REQUEST_URI'], -8);

if ((!isset($_SESSION['user'])) && (!isset($_SESSION['access_token']))) {

    header("Location: index.php");
    exit;
}


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

include('navbar.php');

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Welcome <?php echo $userRow['userName']; ?>!</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
    <script src="https://cdn.tiny.cloud/1/fyga9b2vms5na1vvgr2ey9wn6ms9d7ucfg44hszp3i61u8ll/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            placeholder: "Beschreibung des Workouts"
        });
    </script>
    <script type="text/javascript" src="calendar.js"></script>

</head>

<body>

    <div class="m-2">
        <h2 class="mb-4 mt-4">Überblicksseite von <?php echo $userRow['userName']; ?>
        </h2>

        <ul class="nav nav-tab">
            <li class="active"><a data-toggle="tab" href="#home" class="btn btn-light ml-1 mr-1 mb-2">

                    <h5 class=" text-dark">MyHanno</h5>
                </a></li>
            <li><a data-toggle="tab" href="#menu5" class="btn btn-light ml-1 mr-1 mb-2">
                    <h5 class=" text-dark">Workout-Generator</h5>
                </a></li>

            <li><a data-toggle="tab" href="#menu2" class="btn btn-light ml-1 mr-1 mb-2">
                    <h5 class=" text-dark">Eigenes Workout erstellen</h5>
                </a></li>

            <li><a data-toggle="tab" href="#menu1" class="btn btn-light ml-1 mr-1 mb-2">
                    <h5 class=" text-dark">Meine Workouts</h5>
                </a></li>
            <!-- <li><a data-toggle="tab" href="#menu3" class="btn btn-light ml-2 mr-2">
                <h5 class=" text-dark">Einstellungen</h5>
            </a></li> -->

        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <!-- <h4>Hurra, liebe/r <?php echo $userRow['userName']; ?> !
                <p class="text-dark">Hier ist sie: deine persönliche myHanno-Übersichtsseite.</p>
                <br>
                <br> -->
            </div>


            <div id="menu1" class="tab-pane fade">
                <h3 class="text-secondary mt-3 mb-3">Meine Workouts</h3>

                <?php

                $res3 = mysqli_query($conn, "SELECT * FROM wod where userId = $userId");

                $count = mysqli_num_rows($res3);

                if ($count != 0) {
                ?>

                    <div>

                        <table class="table">
                            <thead class="thead-dark" style="position: sticky;top: 0">
                                <tr>
                                    <th class="header" scope=" col">WodName</th>
                                    <th class="header" scope="col">Equipment</th>
                                    <th class="header" scope="col">Trained Parts</th>
                                    <th class="header" scope="col">Beschreibung</th>
                                    <th class="header" scope="col">Link</th>
                                    <th class="header" scope="col">Min</th>
                                    <th class="header" scope="col">Level</th>
                                    <!-- <th class="header" scope="col">Pts</th> -->
                                    <th class="header" scope="col">Actions</th>


                                </tr>
                            </thead>
                            <tbody>

                            <?php

                            while ($fetch = mysqli_fetch_array($res3)) {

                                $wodId = $fetch['wodId'];
                                $name = $fetch['wodName'];
                                $equiSetId = $fetch['equiSetId'];
                                $equipData = getPictureData($equiSetId);
                                $equipment = $equipData[4];
                                $trainedParts = $fetch['trainedParts'];
                                $description = $fetch['description'];
                                $durationInMinutes = $fetch['durationInMinutes'];
                                $difficulty = $fetch['difficulty'];
                                $link = $fetch['link'];



                                echo "<tr class='$difficulty'>";
                                echo "<td class='table-admin'>$sno : $name </td>";
                                echo "<td class='table-admin'>$equipment</td>";
                                //echo "<td class='table-admin'>$equiSetId</td>";
                                echo "<td class='table-admin'>$trainedParts</td>";
                                echo "<td class='table-admin'>$description</td>";
                                echo "<td class='table-admin'>$link</td>";
                                echo "<td class='table-admin'>$durationInMinutes</td>";
                                echo "<td class='table-admin'>$difficulty</td> ";
                                // echo "<td class='table-admin'>$points</td>";
                                echo "<td><a href='myHanno/deleteWod.php?wodId=$wodId' class='btn btn-outline-danger btn-sm'>Delete </a> 
                                    <a href='myHanno/updateWod.php?wodId=$wodId' class='btn btn-outline-success btn-sm'>Update </a>
                                    <a href='workouts/wodDetail.php?wodId=$wodId' class='btn btn-outline-info btn-sm'>Preview </a>
                            </td>";
                                echo "</tr> ";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            echo "</div>";
                        } else {

                            echo "noch keine selbst erstellten Workouts";
                        }
                            ?>


                    </div>


                    <div id="menu4" class="tab-pane fade">
                        <h3>hahaha</h3>
                        <p>Some content in menu 4.</p>
                    </div>


                    <div id="menu2" class="tab-pane fade">

                        <h3 class="text-secondary mt-3 mb-3">Eigenes Workout erstellen</h3>

                        <form action="./actions/createWod.php" method="POST">
                            <div class="container font-weight-bold">

                                <div class="form-group">
                                    <label for="wodName">Name: </label>
                                    <input type="text" class="form-control mb-3" name="wodName" placeholder="Name Workout" />

                                    <label for="equipment" class="mr-3">Equipment: </label>
                                    <br>
                                    <select name='equipment'>

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

                                        echo "<option> ----Equipment wählen ----- </option>";
                                        while ($row = mysqli_fetch_array($result2)) {

                                            echo $equiSetId = $row['equiSetId'];
                                            echo $e1 = $row['equiPart1'];
                                            $e2 = $row['equiPart2'];
                                            $e3 = $row['equiPart3'];
                                            $e4 = $row['equiPart4'];



                                            echo "<option value= $equiSetId name= 'equipment' class='form-control'> $equiSetId $e1 $e2 $e3 $e4</option>";
                                        }
                                        echo "</select>";



                                        ?>
                                    </select><br><br>



                                    <label for="trainedParts">Muskelgruppen: </label>
                                    <input type="text" class="form-control mb-3" name="trainedParts" placeholder="Trained parts.. zum bsp: Bauchmuskel, Rücken, Oberschenkel.." />

                                    <label for="durationInMinutes">Dauer in Min: </label>
                                    <input type="text" class="form-control mb-3" name="durationInMinutes" placeholder="Dauer des Workouts in Min" />

                                    <label for="difficulty">Level: </label> <br>
                                    <select name="difficulty" id="level" class="mb-3">
                                        <option> ---- Schwierigkeitsgrad ----- </option>
                                        <option value="1" name='difficulty' class='form-control'> easy</option>
                                        <option value="2" name='difficulty' class='form-control'> intermediate</option>
                                        <option value="3" name='difficulty' class='form-control'> hard</option>
                                        <option value="4" name='difficulty' class='form-control'> crossfit</option>
                                        <!-- <option value="5" name='difficulty' class='form-control'> hanni</option>
                <option value="6" name='difficulty' class='form-control'> later</option> -->
                                    </select>

                                    <br>

                                    <!-- <label for="points">Punkte: </label>
<input type="text" class="form-control mb-3" name="points" placeholder="Punkte... zwischen 0 und 30" /> -->

                                    <label for="link">Link: </label>
                                    <input type="text" class="form-control mb-3" name="link" placeholder="eventuell: Link Youtube etc." />


                                    <label for="description" class="mt-3"> Beschreibung Workout</label>
                                    <textarea class="form-control" id="mytextarea" rows="10" name="description" placeholder="Description"></textarea>

                                    <!-- <input type="hidden" name="userId" value="<?php echo $data['wodId'] ?>" /> -->

                                    <input class="form-control btn button_bee mt-3 mb-3" type="submit" name="submit" value="Add Workout" />

                                </div>


                            </div>



                        </form>

                    </div>


                    <!-- <div id="menu3" class="tab-pane fade">
            <h3 class="text-secondary mt-3 mb-3">Einstellungen</h3>
            <p>Hier kann man sich dann Avatar aussuchen und Link instagram/facebook eintragen.</p>
        </div> -->

                    <div id="menu5" class="tab-pane fade">

                        <h2 class="text-secondary mt-3 mb-3">Workout-Generator</h2>
                        <div class="container_wod">

                            <div class="wod_left p-2">

                                <form action="actions/generateWod.php" method='post'>
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
                                                echo $count = mysqli_num_rows($result2);

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




                                            <input class="btn btn-dark form-control mt-4 text-warning" type="submit" name="submit" value="Workout suchen" style="width:90%;" />
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

                                <input class="form-control btn btn-dark text-warning" type="submit" name="submit" value="Nach Workout-Namen suchen" />

                                <input type="text" placeholder="Name des Wods" name="name" class="form-control" onkeyup="searchForWodName(this.value);">


                                <hr>
                                <input class="form-control btn btn-dark text-warning" type="submit" name="submit" value="nach User-Namen suchen" />
                                <input type="text" placeholder="Name Mitglied" name="userName" class="form-control" onkeyup="searchForUserName(this.value);"><br>

                                <hr>

                                <?php


                                $res3 = mysqli_query($conn, "SELECT MAX(wodId) FROM wod");
                                $userRow = mysqli_fetch_array($res3, MYSQLI_ASSOC);

                                $maxWod = $userRow['MAX(wodId)'];

                                $maxWod = rand(1, $maxWod);

                                if ($currentPage == 'home.php') {

                                    echo "<a href='workouts/wodDetail.php?wodId= $maxWod' class='form-control btn btn-dark text-warning mt-4'> Überrascht mich!</a>";
                                } else

                                    echo "<a href='../workouts/wodDetail.php?wodId= $maxWod' class='form-control btn btn-dark text-warning mt-4'> Überrascht mich!</a>";

                                ?>

                            </div>
                        </div>


                        <div id="ergebnis"></div>

                        <hr>


                        <hr>

                    </div>

            </div>


            <h3 class="text-secondary mt-3 mb-3">Mein Trainingskalender</h3>



            <?php
            $res2 = mysqli_query($conn, "SELECT kalender.trainDate, wod.wodId, wod.wodName, wod.difficulty, kalender.comment, kalender.kalenderId
                FROM `kalender`
                inner join wod on wod.wodId = kalender.wodId
                WHERE kalender.userId = $userId");

            $count = mysqli_num_rows($res2);

            if ($count != 0) {
            ?>

                <div>

                    <table class="table">
                        <thead class="thead-dark" style="position: sticky;top: 0">
                            <tr>
                                <th class="header" scope="col">Datum</th>
                                <!-- <th class="header" scope=" col">WodId</th> -->
                                <th class="header" scope=" col">Name Workout</th>
                                <th class="header fadeout" scope=" col">Kategorie</th>
                                <th class="header" scope="col">Notizen</th>
                                <!-- <th class="header" scope="col">mein Rating</th> -->
                                <th class="header" scope="col">Actions</th>


                            </tr>
                        </thead>
                        <tbody>

                        <?php

                        while ($row = mysqli_fetch_assoc($res2)) {
                            $wodId = $row['wodId'];
                            $date = new DateTime($row['trainDate']);
                            $dateDay = $date->format('d.m.Y');
                            $time = $date->format('H:i');
                            $cat = $row['difficulty'];
                            $bgColor = getBGColor($cat);
                            $kalenderId = $row['kalenderId'];



                            echo "<tr style='background-color: $bgColor' >";
                            echo "<td class='table-admin'>" . $dateDay . "<br>" . $time . " </td>";
                            // echo "<td class='table-admin'>" . $row['wodId'] . "</td>";
                            echo "<td class='table-admin'><a title='Details Workout' href='workouts/wodDetail.php?wodId=$wodId'>" . $row['wodName'] . "</a></td>";
                            echo "<td class='table-admin fadeout'>" . $cat . "</td>";
                            echo "<td class='table-admin'>" . $row['comment'] . "</td>";
                            // echo "<td><a href='workouts/wodDetail.php?wodId=$wodId' target='_blank' class='btn btn-dark text-warning btn-sm'>Nochmal!</a> </a>
                            //   </td>";
                            echo "<td><a href='actions/deleteTraining.php?kalenderId=$kalenderId' class='btn btn-secondary text-light btn-sm'>Löschen </a> 
                      <a href='actions/updateTraining.php?kalenderId=$kalenderId' class='btn btn-warning text-light btn-sm'>Bearbeiten </a>
                      <a href='workouts/wodDetail.php?wodId=$wodId' target='_blank' class='btn button_bee btn-sm'>Nochmal!</a> </a>
                    </td>";
                            echo "</tr> ";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                    } else {

                        echo "noch keine absolvierten Workouts";
                    }

                        ?>

                </div>

                <hr>



                <?php
                include('footer.php');
                ?>

                <script type='text/javascript'>
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
                            var url = "actions/ajaxSucheWodName.php";
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
                            var url = "actions/ajaxSucheUserName.php";
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