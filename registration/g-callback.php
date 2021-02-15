<?php
require_once "../config.php";

if (isset($_SESSION['access_token']))
	$gClient->setAccessToken($_SESSION['access_token']);
else if (isset($_GET['code'])) {
	$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
	$_SESSION['access_token'] = $token;
} else {
	header('Location: login.php');
	exit();
}

$oAuth = new Google_Service_Oauth2($gClient);
$userData = $oAuth->userinfo_v2_me->get();

//output
// echo "<pre";
// var_dump($userData);

//here i can save it to the database

//here the version with session
$_SESSION['id'] = $userData['id'];
$oauthUID = $userData['id'];
$_SESSION['email'] = $userData['email'];
$email = $userData['email'];
$_SESSION['gender'] = $userData['gender'];
$_SESSION['picture'] = $userData['picture'];
$_SESSION['familyName'] = $userData['familyName'];
$_SESSION['givenName'] = $userData['givenName'];
$name = ($userData['givenName'] . " " . $userData['familyName']);


$res = mysqli_query($conn, "SELECT * FROM users WHERE userEmail='$email'");
//$obj->read('users',array('useremail'=>$email));

$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
$count = mysqli_num_rows($res);

if ($count == 1) {
	if ($row['oauth_uid'] == '') {
		//echo "es gibt diese Emailadresse im System, aber ohne OAUTH_uID";
		//echo " ich ergänze die OAUTH_uID. du kannst dich zukünftig mit google ID anmelden";
		$sql = mysqli_query($conn, "UPDATE users SET oauth_uid = '$oauthUID', modified = NOW() WHERE userEmail='$email' ");
		header("refresh:2; url= ../home.php");
		exit;
	} else {
		//echo "<br> hurra, Emailadresse mit OAUTH_uID in DB ";
		//echo "ich logge dich ein! Du wirst in 2 sec weitergeleitet";
		header("refresh:2; url= ../home.php");
		exit;
	}
} else {
	//echo "ich lege dich mit Email und OAUTH_uID an und logge dich ein";
	$sql = mysqli_query($conn, "INSERT INTO users (userName, userEmail, oauth_provider, oauth_uid, created ) values ('$name', '$email','google','$oauthUID', NOW()  )");
	header("refresh:6; url=../home.php");
	exit;
}
