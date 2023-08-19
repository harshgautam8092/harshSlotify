<?php
if(isset($_POST['loginButton'])){
	// login button was pressed
	$Username = $_POST['loginUsername'];
	$Password = $_POST['loginUserPassword'];

	// login function

	$result = $account->login($Username, $Password);

	if($result == true){
		$_SESSION['userLoggedIn'] = $Username;
		header("Location: index.php");
	}
}
?>
