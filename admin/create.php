<?php
ob_start();
session_start();
require_once '../config.php';

// if (!isset($_SESSION['superadmin']) && !isset($_SESSION['admin'])) {
if (!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superadmin'])) {
    header("Location: index.php");
    exit;
}
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}

if (isset($_SESSION["admin"])) {

    $res = mysqli_query($conn, "SELECT * FROM users WHERE userId=" . $_SESSION['admin']);
    $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
}

if (isset($_SESSION["superadmin"])) {

    $res = mysqli_query($conn, "SELECT * FROM users WHERE userId=" . $_SESSION['superadmin']);
    $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
}
include('navbarAdmin.php');
?>



<!DOCTYPE html>
<html>

<head>
    <title>Add Workout</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://cdn.tiny.cloud/1/fyga9b2vms5na1vvgr2ey9wn6ms9d7ucfg44hszp3i61u8ll/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- <script src="https://cdn.tiny.cloud/1/a7wzioiy0zx6hb148we9yxp70pjovixkx71drwi6etdiim1b/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
    <script>
        tinymce.init({
            selector: '#mytextarea',
            placeholder: "Beschreibung des Workouts"

        });
    </script>

</head>

<body>

    <div>
        <h1 class="text-success">Neues Workout erstellen</h1>
    </div>

    <form action="a_create.php" method="POST">
        <div class="container font-weight-bold">

            <div class="form-group">
                <label for="wodName">Name: </label>
                <input type="text" class="form-control mb-3" name="wodName" placeholder="Name Workout" />

                <label for="equipment" class="mr-3">Equipment: </label>
                <!-- <input type="text" class="form-control mb-3" name="equipment" placeholder="Equipment OLD!.. zum Bsp: bodyweight, Dumbbell, Springschnur.." />

                <h5 class="pt-3 pb-1">Equipment:</h5> -->


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
ORDER BY `equiSetId` ASC";


                    $result2 = mysqli_query($conn, $sql2);
                    $count = mysqli_num_rows($result2);

                    echo "<option> ----Equipment wählen ----- </option>";
                    while ($row = mysqli_fetch_array($result2)) {

                        echo $equiSetId = $row['equiSetId'];
                        echo $e1 = $row['equiPart1'];
                        $e2 = $row['equiPart2'];
                        $e3 = $row['equiPart3'];
                        $e4 = $row['equiPart4'];


                        //echo "<option> $row[authorID] $row['firstname'] | $row ['lastname']</option>";
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
                    <option value="5" name='difficulty' class='form-control'> hanni</option>
                    <option value="6" name='difficulty' class='form-control'> later</option>
                </select>

                <br>

                <!-- <label for="points">Punkte: </label>
                <input type="text" class="form-control mb-3" name="points" placeholder="Punkte... zwischen 0 und 30" /> -->

                <label for="link">Link: </label>
                <input type="text" class="form-control mb-3" name="link" placeholder="eventuell: Link Youtube etc." />


                <label for="description" class="mt-3"> Beschreibung Workout</label>
                <textarea class="form-control" id="mytextarea" rows="10" name="description" placeholder="Description"></textarea>

                <!-- <input type="hidden" name="userId" value="<?php echo $data['wodId'] ?>" /> -->

                <input class="form-control btn btn-outline-success mt-3 mb-3" type="submit" name="submit" value="Add Workout" />

                <a href="admin.php" class="btn btn-block btn-outline-warning">Back</a>

            </div>


        </div>



    </form>
    </div>

    <?php
    // }

    // Close connection
    mysqli_close($conn);
    ?>
    </div>




</body>

</html>