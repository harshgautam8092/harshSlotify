<?php

if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {

	include("Includes/config.php");
	include("Includes/classes/User.php");
	include("Includes/classes/Singer.php");
	include("Includes/classes/Album.php");
	include("Includes/classes/Song.php");
	include("Includes/classes/Playlist.php");


	if(isset($_GET['userLoggedIn'])) {
		$userLoggedIn = new User($conn, $_GET['userLoggedIn']);
	}else{
		echo "username variable was not passed into page. Check the openPage JS function";
	}

}else{
	include("Includes/header.php");
	include("Includes/footer.php");

	$url = $_SERVER['REQUEST_URI'];
	echo "<script>openPage('$url')</script>";
	exit();
}

?>