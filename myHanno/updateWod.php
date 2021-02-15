<?php
ob_start();
session_start();
require_once '../config.php';
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


// select logged-in users details
$res = mysqli_query($conn, "SELECT * FROM users WHERE userId=$userId");
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

include('../workouts/navbarWod.php');

if ($_GET['wodId']) {
    $wodId = $_GET['wodId'];

    $sql = "SELECT * FROM wod 
   WHERE wodId = $wodId";

    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $chosen = $data['equiSetId'];
?>

    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <title>Edit </title>
        <link rel="stylesheet" href="../style.css">
        <script src="https://cdn.tiny.cloud/1/fyga9b2vms5na1vvgr2ey9wn6ms9d7ucfg44hszp3i61u8ll/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <!-- <script src="https://cdn.tiny.cloud/1/zmvdg0nz5rrmxbcvtzfsgb1nmc7iuq8uotrbbxfxt5iu5yol/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
        <script>
            tinymce.init({
                selector: '#mytextarea',
                placeholder: "Hier kannst du deinen Beitrag erstellen und formatieren.."

            });
        </script>

    </head>

    <body>

        <div class="mx-auto">
            <h1 class="mx-auto text-success">Update Workout</h1>
        </div>


        <form action="a_updateWod.php" class="ml-10" method="post">
            <div class=" container font-weight-bold">

                <div class="form-group">
                    <label for="wodName">Name: </label>
                    <input type="text" class="form-control mb-3" name="wodName" value="<?php echo $data['wodName'] ?>" />

                    <label for="equipment">Equipment: </label>
                    <!-- <input type="text" class="form-control mb-3" name="equipment" value="<?php echo $data['equipment'] ?>" /> -->

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

                        echo "<option> $chosen </option>";
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
                    <input type="text" class="form-control mb-3" name="trainedParts" placehold rows="2" er="title" value="<?php echo $data['trainedParts'] ?>" />

                    <label for="durationInMinutes">Dauer in Min: </label>
                    <input type="text" class="form-control mb-3" name="durationInMinutes" value="<?php echo $data['durationInMinutes'] ?>" />

                    <label for="difficulty">Level: </label> <br>
                    <select name="difficulty" id="level" class="mb-3">
                        <option> <?php echo $data['difficulty'] ?> </option>
                        <option value="1" name='difficulty' class='form-control'> easy</option>
                        <option value="2" name='difficulty' class='form-control'> intermediate</option>
                        <option value="3" name='difficulty' class='form-control'> hard</option>
                        <option value="4" name='difficulty' class='form-control'> crossfit</option>
                        <!-- <option value="5" name='difficulty' class='form-control'> hanni</option>
                        <option value="6" name='difficulty' class='form-control'> later</option> -->
                    </select>

                    <br>
                    <!-- <label for="difficulty">Level: </label>
                    <input type="text" class="form-control mb-3" name="difficulty" value="<?php echo $data['difficulty'] ?>" /> -->

                    <!-- <label for="points">Punkte: </label>
                    <input type="text" class="form-control mb-3" name="points" value="<?php echo $data['points'] ?>" /> -->

                    <label for="link">Link: </label>
                    <input type="text" class="form-control mb-3" name="link" value="<?php echo $data['link'] ?>" />

                    <label for="description" class="mt-3"> Beschreibung Workout</label>
                    <textarea class="form-control" id="mytextarea" rows="10" name="description"> <?php echo $data['description'] ?> </textarea>

                    <input type="hidden" name="wodId" value="<?php echo $data['wodId'] ?>" />

                    <input class="form-control btn btn-outline-success mt-3 mb-3" type="submit" name="submit" value="Änderungen speichern" />

                    <a href="../home.php" class="btn btn-block btn-outline-warning">Zurück</a>

                </div>



            </div>
        </form>



        <!-- </fieldset> -->

    </body>

    </html>

<?php
}
?>