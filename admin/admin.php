<?php
ob_start();
session_start();
require_once '../config.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superadmin'])) {
    header("Location: index.php");
    exit;
}
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}
// select logged-in users details

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
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">

    <!-- Title Page-->
    <title>Admin Page</title>



</head>

<body>


    <hr>

    <!-- ADMIN PANEL start  -->
    <div class="mx-auto text-center pt-2 pb-2">
        <div>
            <h1>Admin Panel</h1>
        </div>
    </div>

    <div class="containerWod">
        <?php
        //SUM LEVEL ONLY 
        // $sql2 = "SELECT wod.difficulty, equset.equiSetId as 'cat', count(wod.wodId) as 'count' from wod
        // inner JOIN equset on wod.equiSetId = equset.equiSetId
        // group by wod.difficulty, equset.equiSetId";

        //SUM EQUISETS
        $sql2 = "SELECT wod.difficulty,
        count(IF(wod.equiSetId=1, wod.equiSetId, NULL)) AS bodyweight,
        count(IF(wod.equiSetId=2, wod.equiSetId, NULL)) AS pullupbar,
        count(IF(wod.equiSetId=3, wod.equiSetId, NULL)) AS box,
        count(IF(wod.equiSetId=4, wod.equiSetId, NULL)) AS rings,
        count(IF(wod.equiSetId=5, wod.equiSetId, NULL)) AS dumbbell,
        count(IF(wod.equiSetId=6, wod.equiSetId, NULL)) AS kb,
        count(IF(wod.equiSetId=7, wod.equiSetId, NULL)) AS bands,
        count(IF(wod.equiSetId=8, wod.equiSetId, NULL)) AS barbell,
        count(IF(wod.equiSetId=9, wod.equiSetId, NULL)) AS wallball,
        count(IF(wod.equiSetId=10, wod.equiSetId, NULL)) AS jumprope,
        count(IF(wod.equiSetId between 11 and 30, wod.equiSetId, NULL)) AS other
        FROM wod
        GROUP BY wod.difficulty";


        $result2 = mysqli_query($conn, $sql2);
        // fetch the next row (as long as there are any) into $row
        while ($row = mysqli_fetch_assoc($result2)) {
            $category = $row['difficulty'];
            $body = $row['bodyweight'];
            $pullup = $row['pullupbar'];
            $box = $row['box'];
            $rings = $row['rings'];
            $dumbbell = $row['dumbbell'];
            $kb = $row['kb'];
            $bands = $row['bands'];
            $barbell = $row['barbell'];
            $wallball = $row['wallball'];
            $jr = $row['jumprope'];
            $other = $row['other'];
            $count = $body + $pullup + $box + $rings + $dumbbell + $kb + $bands + $barbell + $wallball + $jr + $other;

            echo " <div class='square $category'>";
            echo "<br>";
            echo "<a href='catview.php?cat=$category'><h3>$category</h3></a>";
            // echo "<br>";
            echo "<h1>$count</h1>";
            echo "<h7> bw / pubar / box / rings / jr </h7>";
            echo "<h7>$body / $pullup / $box / $rings / $jr </h7>";
            echo "<h6> db / kb / band / wb / bb </h6>";
            echo "<h6> $dumbbell / $kb / $bands / $wallball /$barbell </h6>";
            echo "<h6> combined: $other </h6>";
            echo " </div>";
        }
        echo " </div>";
        echo "<br>";

        //Pagination
        $rowperpage = 10;
        $row = 0;

        //First Page
        if (isset($_POST['first'])) {
            $row = 0;
        }


        //Last Page
        if (isset($_POST['last'])) {
            $max = $_POST['allcount'];
            $row = $max - $max % $rowperpage;
        }

        // Previous Button 
        if (isset($_POST['but_prev'])) {
            $row = $_POST['row'];
            $row -= $rowperpage;
            if ($row < 0) {
                $row = 0;
            }
        }

        // Next Button
        if (isset($_POST['but_next'])) {
            $row = $_POST['row'];
            $allcount = $_POST['allcount'];

            $val = $row + $rowperpage;
            if ($val < $allcount) {
                $row = $val;
            }
        }

        ?>


        <div class="containerAdmin">

            <table class="table">
                <thead class="thead-dark" style="position: sticky;top: 0">
                    <tr>
                        <th class="header" scope=" col">WodName</th>
                        <th class="header" scope="col">Equipment</th>
                        <th class="header" scope="col">Equpmt New</th>
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

                    // count total number of rows
                    $sql = "SELECT COUNT(*) AS cntrows FROM wod";
                    $result = mysqli_query($conn, $sql);
                    $fetchresult = mysqli_fetch_array($result);
                    $allcount = $fetchresult['cntrows'];

                    // selecting rows
                    $sql = "SELECT * FROM wod ORDER BY wodId ASC limit $row," . $rowperpage;
                    $result = mysqli_query($conn, $sql);
                    $sno = $row + 1;

                    // while ($row = mysqli_fetch_assoc($result)) {
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



                        echo "<tr class='$difficulty'>";
                        echo "<td class='table-admin'>$sno : $name </td>";
                        echo "<td class='table-admin'>$equipment</td>";
                        echo "<td class='table-admin'>$equiSetId</td>";
                        echo "<td class='table-admin'>$trainedParts</td>";
                        echo "<td class='table-admin'>$description</td>";
                        echo "<td class='table-admin'>$link</td>";
                        echo "<td class='table-admin'>$durationInMinutes</td>";
                        echo "<td class='table-admin'>$difficulty</td> ";
                        // echo "<td class='table-admin'>$points</td>";
                        echo "<td><a href='delete.php?wodId=$wodId' class='btn btn-outline-danger btn-sm'>Delete </a> 
                               <a href='update.php?wodId=$wodId' class='btn btn-outline-success btn-sm'>Update </a>
                               <a href='preview.php?wodId=$wodId' target='_blank' class='btn btn-outline-info btn-sm'>Preview </a>
                     </td>";
                        echo "</tr> ";
                        $sno++;

                    ?>
                </tbody>
            <?php

                    }
            ?>
            </table>

            <form method="post" action="" class="d-flex justify-content-center">
                <div id="div_pagination">
                    <input type="hidden" name="row" value="<?php echo $row; ?>">
                    <input type="hidden" name="allcount" value="<?php echo $allcount; ?>">
                    <input type="submit" class="button btn-outline-success rounded" name="first" value="erste Seite">
                    <input type="submit" class="button btn-outline-success rounded" name="but_prev" value="zurück">
                    <input type="submit" class="button btn-outline-success rounded" name="but_next" value="weiter">
                    <input type="submit" class="button btn-outline-success rounded" name="last" value="letzte Seite">

                </div>
            </form>

            <?php


            // Free result set
            mysqli_free_result($result);
            // Close connection
            mysqli_close($conn);
            ?>

        </div>


</body>

</html>