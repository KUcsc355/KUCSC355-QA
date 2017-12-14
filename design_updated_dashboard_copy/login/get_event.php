<?php
	//TODO don't forget to change the name of this file to get_event.php and delete the get_user file off the server
	header("Content-Type: application/json");
	$idEvent = $_GET["idEvent"];
	$conn = new mysqli('lvaitpsitedb.c8yagni7c74b.us-east-2.rds.amazonaws.com', 'awsuser', 'Kutztown', 'lvaitpdb')
	or die ('Cannot connect to db');

	// switch from user table to event, add correct columns in select
	if ($statement = $conn->prepare("SELECT name, speaker, date, street1, city, zip, fee, description FROM Event WHERE eventID = ?")) {
		$statement->bind_param("i", $idEvent);

		$statement->execute();

		// add variables in order for each column in the select
		$statement->bind_result($eventName, $speakerName, $date, $street, $city, $zip, $fee, $description);

		$statement->fetch();

		// add line for each column/variable added above
		$event = array(
			"eventName" => $eventName,
			"speakerName" => $speakerName,
			"date" => $date,
			"street" => $street,
			"city" => $city,
			"zip" => $zip,
			"fee" => $fee,
			"description" => $description
		);
		echo json_encode($event, JSON_PRETTY_PRINT);

	}

	/*
		For this file, the changes will be to change:
		1. $userId to "eventId = $_GET["eventId"];
		2. Line 10, change the select statement for event categories
		3. Line 16, change variables to new ones
		4. Line 22, Change array variables to match new ones
	*/
?>
