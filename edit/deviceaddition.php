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
<link rel=stylesheet href="../default.css">
</head>												
<body>
<!-- Bootstrap Navbar -->
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		<!-- Web App Links -->
		<ul class="navbar-nav">
			<li class="nav-item"><a class="nav-link" href="../wamnet.php">Home</a></li>
			<!-- Devices Dropdown -->
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">View &amp; Edit</a>
				<!-- Dropdown links for Devices Pages -->
				<div class="dropdown-menu">
				<a class="dropdown-item" href="../forms/allports.php">All Ports</a>
				<a class="dropdown-item" href="../forms/oneport.php">One Port</a>
				<a class="dropdown-item" href="../forms/connection.php">Connection Path</a>
			</div>
			</li>
			<!-- Add/Remove Dropdown -->
			<li class="nav-item dropdown active">
				<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Add &amp; Remove</a>
				<!-- Dropdown links for Add/Remove Pages -->
				<div class="dropdown-menu">
					<a class="dropdown-item" href="../forms/adddevice.php">Add Device</a>
					<a class="dropdown-item" href="../forms/addport.php">Add Port</a>
					<a class="dropdown-item" href="../forms/removedevice.php">Remove Device</a>
				</div>
			</li>
			<li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
		</ul>
	</nav>
<?php
	require('../model/database.php');
	$_SESSION['deviceType'] = $_POST['type'];
	$_SESSION['deviceName'] = $_POST['name'];
	$_SESSION['rackName'] = $_POST['racks'];

	//Insert into devices table using parameters for POST variables
	$stmt = $dsn->prepare("INSERT INTO devices (deviceType, deviceName, rackName) VALUES (:deviceType, :deviceName, :rackName)");
	$stmt->bindParam(':deviceType', $_SESSION['deviceType']);
	$stmt->bindParam(':deviceName', $_SESSION['deviceName']);
	$stmt->bindParam(':rackName', $_SESSION['rackName']);
	$stmt->execute();
	
	//Select newly added device via deviceName parameter to confirm addition to user in table display
	$stmt = $dsn->prepare("SELECT * FROM devices WHERE deviceName = :deviceName");
	$stmt->bindParam(':deviceName', $_SESSION['deviceName']);
	$stmt->execute();
?>
	<div class='spacer'></div>
	<div class='container-fluid centerDiv' id='myFullData'>
	<div class='alert alert-success'>
	<strong>Success!</strong> You have added the following device information.
	</div>
	<br>
	<table border='1' id='myTableData' class='table table-striped'>
    <tr>
    <th>Device ID</th>
    <th>Device Type</th>
    <th>Device Name</th>
    <th>Rack Name</th>
    </tr>
	<?php
			// output data of each row
			while($row = $stmt->fetch()) {
				echo "<tr>";
				echo "<td>" . $row['deviceID'] . "</td>";
				echo "<td>" . $row['deviceType'] . "</td>";
				echo "<td>" . $row['deviceName'] . "</td>";
				echo "<td>" . $row['rackName'] . "</td>";
				echo "</tr>";
			}
	?>
</table>
</div>";
<div class="footer"></div>
</body>
</html>