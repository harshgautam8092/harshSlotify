<?php 
include("../../config.php");

if(isset($_POST['singerId'])) {
	$singerId = $_POST['singerId'];

	$query = mysqli_query($conn, "SELECT * FROM singers WHERE id='$singerId'");

	$resultArray = mysqli_fetch_array($query);

	echo json_encode($resultArray);
}
?>