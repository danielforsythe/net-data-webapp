<?php
	// Check for session, if no session start session
	if(!isset($_SESSION)){ session_start(); }
	// Check for valid login session, if login verified redirect to homepage
	if(isset($_SESSION['login'])) { header("Location: wamnet.php"); }
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width inital-scale=1.0">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="author" content="Daniel Forsythe">
<title>Wamnet App</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- Default CSS -->
<link rel=stylesheet href="default.css">
</head>
<body>
<!-- Bootstrap Navbar -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
	<!-- Web App Links -->
	<ul class="navbar-nav">
		<li class="nav-item"><a class="nav-link" href="wamnet.php">Home</a></li>
	</ul>
</nav>
<!-- Create space from navigation bar -->
<div class="spacer"></div>
<!-- Login Form, Uses centerDiv style -->
<div class="container-fluid centerDiv" id="myLogin">
	<h2>Wamnet IT Login</h2>
	<!-- POST username & password to default.php to check for login credentials -->
	<form action="validate.php" method="post">
		<div class="form-group">
			<!-- Hidden input, creates login variable for POST, will be used to create valid/invalid login session -->
			<input type="hidden" name="login" value="login" id="login">
			<!-- Username Credential -->
			<label for="user"><strong>User:</strong></label>
			<input type="text" class="form-control" id="user" placeholder="Enter username..." name="user">
		</div>
		<div class="form-group">
			<!-- Password Credential --><!-- Uses secure password display for input text -->
			<label for="pwd"><strong>Password:</strong></label>
			<input type="password" class="form-control" id="pwd" placeholder="Enter password..." name="pwd">
		</div>
		<!-- Submit button to POST login -->
		<button type="submit" class="btn btn-primary">Login</button>
	</form>
</div>
<!-- Default Footer -->
<div class="footer"></div>
</body>
</html>