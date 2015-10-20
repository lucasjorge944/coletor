<?php
	$servername = "localhost";
	$username = "root";
	$password = "17059493";
	$dbname = "db_tig";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
?>