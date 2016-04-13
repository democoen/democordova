<?php

	include 'db_config.php';

	$sql =  "SELECT e.id, e.firstName, e.lastName, e.title, e.email, count(r.id) AS reportCount " . 
			"FROM address e " . 
			"LEFT JOIN address r ON r.managerId = e.id " .
			"GROUP BY e.id " .
			"ORDER BY e.lastName, e.firstName";

	try {
		$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $dbh->query($sql);  
		$addresses = $stmt->fetchAll(PDO::FETCH_OBJ);
		$dbh = null;
		echo '{"items":'. json_encode($addresses) .'}'; 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}

?>