<?php
	
	$servername = "localhost";
	$dbname = "web_board";
	$username = "root";
	$password = "";

	try {

		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->exec("SET NAMES UTF8");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo 'Connected successfully!';
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
?>