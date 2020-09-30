<?php
	// DB Credentials
	$servername = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbname = "wamnet";

	// POST from Login Page
	$user = $_POST['user'];
	$pwd = $_POST['pwd'];

	// Initalize valid variable to set to Boolean value if login verified
	$valid = '';

	try {
		// PDO Connection to MySQL DB
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// Select the SHA256 stored Password from accounts table WHERE username equals :user value
		$query = "SELECT password FROM accounts WHERE username = :user";
		$stmt = $conn->prepare($query);
		
		// Bind the POST username to the :user value
		$stmt->bindValue(':user', $user);
		$stmt->execute();
		$row = $stmt->fetch();
		
		// Return results if any exist
		if ($row){
			$stmt->closeCursor();
			// Store the SHA256 password pulled from accounts as $hash variable
			$hash = $row['password'];
			// Use password verify function to compare stored hashed password to inputed password
			$valid = password_verify($pwd, $hash);
		}
		// If passwords match $valid is set to a value of 1, create a valid login session to gain web application access
		if ($valid == 1){
			$_SESSION['login'] = $_POST['login'];
		}
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
?>