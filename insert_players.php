<?php

	// Get cURL resource
	$ch = curl_init();

	// Set url
	curl_setopt($ch, CURLOPT_URL, "https://api.mysportsfeeds.com/v2.1/pull/mlb/players.json?rosterstatus=assigned-to-roster,assigned-to-injury-list&position=C,1B,2B,3B,SS,LF,CF,RF");

	// Set method
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

	// Set options
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	// Set compression
	curl_setopt($ch, CURLOPT_ENCODING, "gzip");

	// Set headers
	$headers = array(
	    'Content-type: application/json; charset=UTF-8',
	    "Authorization: Basic " . base64_encode("3e610f3c-19bb-400c-b0b6-887575" . ":" . "MYSPORTSFEEDS"),
	);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	// Send the request & save response to $resp
	$resp = curl_exec($ch);
	$response = json_decode($resp);




	try {
	    include("_db_connect_string.php");
	  } catch (PDOException $e) {
	  echo 'Connection failed: ' . $e->getMessage();
	  die();
	}

	$player_id = $_GET['player_id'];

	$stmt = $dbh->prepare("INSERT INTO players (PlayerID,FirstName,LastName) VALUES (?, ?, ?, ?, ?)");
	$stmt->bindParam(1, $league_id, PDO::PARAM_INT);
	$stmt->bindParam(2, $team_id, PDO::PARAM_INT);
	$stmt->bindParam(3, $player_id, PDO::PARAM_INT);
	$stmt->bindParam(4, $status_id, PDO::PARAM_INT);
	$stmt->bindParam(5, $sort, PDO::PARAM_INT);

	// insert one row
	$league_id = 1;
	$team_id = 1;
	$player_id = $player_id;
	$status_id = 1;
	$sort = 1;
	$stmt->execute();


	curl_close($ch);

?>
