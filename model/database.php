<?php
	// DB Credentials
	$user = "root";
	$pwd = "";
	try{
		$dsn = new PDO("mysql:host=127.0.0.1;dbname=wamnet", $user, $pwd);
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
?>