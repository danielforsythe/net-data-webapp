<?php 
	// Check for session, if no session start session
	if(!isset($_SESSION))
	{
		session_start();
	}
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
<title>WamNet Ver 1.0</title>
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- TableEdit Jquery Plugin -->
<script type="text/javascript" src="../dist/jquery.tabledit.js"></script>
<!-- Custom Table Edit (tableEdit) -->
<script type="text/javascript" src="../dist/connection-full.tabledit.js"></script>
<link rel="stylesheet" href="../default.css">
</head>													
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Links -->
  <ul class="navbar-nav">
	<li class="nav-item">
		<a class="nav-link" href="../wamnet.php">Home</a>  
	</li>
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Devices
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="../forms/allports.php">All Ports</a>
        <a class="dropdown-item" href="../forms/oneport.php">One Port</a>
		<a class="dropdown-item" href="../forms/connection.php">Connection Path</a>
      </div>
    </li>
	  <li class="nav-item dropdown active">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Add/Remove
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="../forms/adddevice.php">Add Device</a>
        <a class="dropdown-item" href="../forms/addport.php">Add Port</a>
		<a class="dropdown-item" href="../forms/removedevice.php">Remove Device</a>
      </div>
    </li>
	  <li class="nav-item">
	  	<a class="nav-link" href="../view_all.php">View Database</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="../logout.php">Logout</a>  
	</li>
  </ul>
</nav>
<?php
	require('../model/database.php');
	$_SESSION['device'] = $_POST['devices'];
	
	// Delete from device_ports 1st because of foreign key restraints
	$stmt = $dsn->prepare("DELETE FROM device_ports WHERE deviceName = :deviceName");
	$stmt->bindParam(':deviceName', $_SESSION['device']);
	$stmt->execute();
	
	//Then delete from parent devices table
	$stmt = $dsn->prepare("DELETE FROM devices WHERE deviceName = :deviceName");
	$stmt->bindParam(':deviceName', $_SESSION['device']);
	$stmt->execute();
	
	// Automatic redirect to homepage
	header("Location: ../wamnet.php");
?>
</body>
</html>