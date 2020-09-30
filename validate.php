<?php
	// Check for session, if no session start session
	if(!isset($_SESSION))
	{
		session_start();
	}
	// POST Login Credentials to verify login status
	include('model/admin.php');
	// Check to see if login authorization attempted, if no login attempt found then default back to login index page
	if(!isset($_SESSION['login'])) {
		header("Location: .");
	}
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
<?php
	// Check to see if Login Session created by admin.php, if verified proceed to wamnet application
	if(isset($_SESSION['login'])){
		header("Location: wamnet.php");
	}
?>
</body>
</html>