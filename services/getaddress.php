<?php

	include 'db_config.php';
	
	$sql = "SELECT a.id, a.firstName, a.lastName, a.managerId, a.title, a.department, a.city, a.officePhone, a.cellPhone, a.email, " .
			"m.firstName managerFirstName, m.lastName managerLastName, count(r.id) reportCount " . 
			"FROM address a " .
			"LEFT JOIN address r ON r.managerId = a.id " .
			"LEFT JOIN address m ON a.managerId = m.id " .
			"WHERE a.id = :id " . 
			"GROUP BY a.lastName " .
			"ORDER BY a.lastName, a.firstName";

	try {
		$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $dbh->prepare($sql);  
		$stmt->bindParam("id", $_GET['id']);
		$stmt->execute();
		$address = $stmt->fetchObject();
		$dbh = null;
		echo '{"item":'. json_encode($address) .'}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}

?>