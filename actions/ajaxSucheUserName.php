<?php

require_once '../config.php';
include('funktionen.php');
$previousPage = substr($_SERVER['HTTP_REFERER'], -8);

if ($_POST["suchbegriff"]) {

	$sql = "select wod.*, AVG(rating) as 'rating' from wod
	left join rating on rating.wodId = wod.wodId
	inner join users on wod.userId = users.userId
	where users.userName like ('%" . mysqli_real_escape_string($conn, utf8_decode($_POST["suchbegriff"])) . "%')
	GROUP BY wod.wodId
	";

	$result = mysqli_query($conn, $sql);

	// Suchbegriff wird ausgegeben
	echo "Suche nach workouts von user: " . $_POST["suchbegriff"] . "<br/><br/>";
	echo "<div class='container_genwod'>";

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
		$user = $fetch['userName'];
		$rating = $fetch['rating'];
		if ($rating == "") {
			$rating = 0.001;
		}
		$cat = getBGColor($difficulty);
		$picData = getPictureData($equiSetId);
		$pic_style = $picData[1];
		$pic = $picData[0];
		if ($previousPage == "home.php") {
			$pic = $picData[2];
		}
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
				<p class="card-text">von user <?php echo $user; ?> </p>
				<a href="../workouts/wodDetail.php?wodId=<?php echo $wodId; ?>" class="btn button_bee"> Zum Workout</a>
			</div>
		</div>

<?php

		// $conn->close();
	}
	echo "</div>";
}
?>