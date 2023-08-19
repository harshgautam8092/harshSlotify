<?php
	include("Includes/config.php");
	include("Includes/classes/Account.php");
	include("Includes/classes/Constants.php");

	$account = new Account($conn);


	include("Includes/handlers/register-handler.php");
	include("Includes/handlers/login-handler.php");

	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}

?>

	




<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome to Slotifyt</title>


	<link rel="stylesheet" type="text/css" href="assets/css/register.css">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src ="assets/js/register.js"></script>

</head>
<body>

	<?php 
	if(isset($_POST['registerButton'])) {
		echo '<script>
				$(document).ready(function() {
					$("#loginForm").hide();
					$("#registerForm").show();
				});
			</script>';
	}else{
		echo '<script>
			    $(document).ready(function() {
				    $("#loginForm").show();
				    $("#registerForm").hide();
			    });
		    </script>';
	   
    }
	?>

	<div id="background">
		<div id="loginContainer">
			<div id="inputContainer">
				<form id="loginForm" action="register.php" method="POST">
					<h2>Login to your <span class="Slotify">Slotify Account</span></h2>
					<p>
						<?php echo $account->getError(Constants::$loginFailed); ?>
						<label for="loginUsername">Username</label>
						<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. HarshGautam" value="<?php getInputValue('loginUsername') ?>" required>
					</p>

					<p>
						<label for="loginUserPassword">Password</label>
						<input id="loginUserPassword" name="loginUserPassword" type="password" placeholder="Your password" required>
					</p>

					<button type="submit" name="loginButton">LOG IN</button>

					<div class="hasAccountText">
						<span id="hideLogin">Don't have an account yet? Signup here.</span>
					</div>


				</form>

				<form id="registerForm" action="register.php" method="POST">
					<h2>Create your free <br> <span class="Slotify">Slotify Account</span></h2>
					<p>
						<?php echo $account->getError(Constants::$usernameCharacters); ?>
						<?php echo $account->getError(Constants::$usernameTaken); ?>
						<label for="Username">Username</label>
						<input id="Username" name="Username" type="text" placeholder="e.g. HashGautam"  value="<?php getInputValue('Username') ?>"  required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$firstNameCharacters); ?>
						<label for="FirstName">First Name</label>
						<input id="FirstName" name="FirstName" type="text" placeholder="e.g. Hash" value="<?php getInputValue('FirstName') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$lastNameCharacters); ?>
						<label for="LastName">Last Name</label>
						<input id="LastName" name="LastName" type="text" placeholder="e.g. Gautam" value="<?php getInputValue('LastName') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
						<?php echo $account->getError(Constants::$emailInvalid); ?>
						<?php echo $account->getError(Constants::$emailTaken); ?>
						<label for="email">Email</label>
						<input id="email" name="email" type="email" placeholder="e.g. harshgautam@gmail.com" value="<?php getInputValue('email') ?>" required>
					</p>

					<p>
						<label for="email2">Confirm Email</label>
						<input id="email2" name="email2" type="email" placeholder="e.g. harshgautam@gmail.com" value="<?php getInputValue('email2') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$passwordsDoNoMatch); ?>
						<?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
						<?php echo $account->getError(Constants::$passwordCharacters); ?>
						<label for="password">Password</label>
						<input id="password" name="password" type="password" placeholder="Your password" required>
					</p>

					<p>
						<label for="password2">Confirm Password</label>
						<input id="password2" name="password2" type="password" placeholder="Your password" required>
					</p>

					<button type="submit" name="registerButton">SIGN UP</button>

					<div class="hasAccountText">
						<span id="hideRegister">Already have an account? Log in here.</span>
					</div>

				</form>
			</div>

			<div id="loginText">
				<h1>Get the latest trending, right now</h1>
				<h2>Listen to loads of songs for free</h2>
				<ul>
					<li>Discover music you'll fall in love with </li>
					<li>Create your own library</li>
					<li>Follow singers to keep up to date </li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>