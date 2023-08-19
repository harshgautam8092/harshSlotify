<?php
include("Includes/config.php");
include("Includes/classes/User.php");
include("Includes/classes/Singer.php");
include("Includes/classes/Album.php");
include("Includes/classes/Song.php");
include("Includes/classes/Playlist.php");

//session_destroy(); Logout manually

if(isset($_SESSION['userLoggedIn'])) {
	$userLoggedIn = new User($conn, $_SESSION['userLoggedIn']);
	$username = $userLoggedIn->getUsername();
	echo "<script>userLoggedIn = '$username';</script>";
}else{
	header("Location: register.php");
}
?>


<html>
<head>
	<title>Welcome to Slotify!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> 
	<script src="assets/js/script.js"></script>
</head>
<body>

	<div id="mainContainer">

		<div id="topContainer"> 

			<?php include("Includes/navBarContainer.php"); ?>

			<div id="mainViewContainer">
				
				<div id="mainContent">