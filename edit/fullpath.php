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
			<li class="nav-item dropdown active">
				<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">View &amp; Edit</a>
				<!-- Dropdown links for Devices Pages -->
				<div class="dropdown-menu">
				<a class="dropdown-item" href="../forms/allports.php">All Ports</a>
				<a class="dropdown-item" href="../forms/oneport.php">One Port</a>
				<a class="dropdown-item" href="../forms/connection.php">Connection Path</a>
			</div>
			</li>
			<!-- Add/Remove Dropdown -->
			<li class="nav-item dropdown">
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
		// Access the DB using PDO
		require('../model/database.php');
		// Get selected device and portID from POST
		$_SESSION['device'] = $_POST['devices'];
		$_SESSION['portID'] = $_POST['ports'];
		// Query to gather full connection path includes: Device A, Device B, Patchpanel A, Patchpanel B, and the Cable #
		// Self join patchpanel and devce ports tables to get Device A/B and Patchpanel A/B
		// Patchpanel A & Patchpanel B cannot equal each other
		// Device A & Device B cannot equal each other
		// The cableID must match between Device A and Device B
		// The cableID must match between Patchpanel A and Patchpanel B
		// Lastly Device A name and port must match the POST values
		// Limit 1 to prevent reduandancy, by default query will get 2 results, one for each device as Device A
		$stmt = $dsn->query("SELECT CONCAT (A.deviceName, '-', A.portNumber) AS 1stDevice,
									CONCAT (B.deviceName, '-', B.portNumber) AS 2ndDevice,
									CONCAT (X.patchPanelName, '-', X.portNumber) AS PatchPanelOne,
									CONCAT (Y.patchPanelName, '-', Y.portNumber) AS PatchPanelTwo,
									A.cableID
									FROM (device_ports A, device_ports B, patchpanel_ports X, patchpanel_ports Y)
									WHERE X.patchPanelName <> Y.patchPanelName
									AND A.deviceName <> B.deviceName
									AND A.cableID = B.cableID
									AND X.cableID = Y.cableID
									AND A.portID = '{$_SESSION['portID']}'
									AND A.deviceName = '{$_SESSION['device']}'
									LIMIT 1");
	?>
	
	<div class='spacer'></div>
	<div class='container-fluid centerDiv' id='myFullData'><br>
	<table border='1' id='myTableData' class='table table-striped'>
		<tr>
		<th>First Device</th>
		<th>Second Device</th>
		<th>PatchPanelOne</th>
		<th>PatchPanelTwo</th>
		<th>Cable ID</th>
		</tr>
	<?php
		// output data of each row
		while($row = $stmt->fetch()) {
			echo "<tr>";
			echo "<td>" . $row['1stDevice'] . "</td>";
			echo "<td>" . $row['2ndDevice'] . "</td>";
			echo "<td>" . $row['PatchPanelOne'] . "</td>";
			echo "<td>" . $row['PatchPanelTwo'] . "</td>";
			echo "<td>" . $row['cableID'] . "</td>";
			echo "</tr>";
		}
	?>
</table>
</div>
<div class="footer"></div>
</body>
</html>