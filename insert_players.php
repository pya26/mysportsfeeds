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

	

	foreach($response->players as $key => $value) {  

		$stmt = $dbh->prepare("INSERT INTO players (PlayerID,FirstName,LastName,PrimaryPosition,JerseyNumber,TeamID,TeamAbbr,Height,Weight,DOB,Age,BirthCity,BirthCountry,HighSchool,College,Bats,Throws,MLBImage,MLBID) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->bindParam(1, $player_id, PDO::PARAM_INT);
		$stmt->bindParam(2, $first_name, PDO::PARAM_STR, 30);
		$stmt->bindParam(3, $last_name, PDO::PARAM_STR, 50);
		$stmt->bindParam(4, $position, PDO::PARAM_STR, 3);
		$stmt->bindParam(5, $jersey_num, PDO::PARAM_INT);
		$stmt->bindParam(6, $team_id, PDO::PARAM_INT);
		$stmt->bindParam(7, $team_abbr, PDO::PARAM_STR, 5);
		$stmt->bindParam(8, $height, PDO::PARAM_STR, 5);
		$stmt->bindParam(9, $weight, PDO::PARAM_STR, 8);
		$stmt->bindParam(10, $dob, PDO::PARAM_STR, 10);
		$stmt->bindParam(11, $age, PDO::PARAM_INT);
		$stmt->bindParam(12, $birth_city, PDO::PARAM_STR,75);
		$stmt->bindParam(13, $birth_country, PDO::PARAM_STR,75);
		$stmt->bindParam(14, $high_school, PDO::PARAM_STR,100);
		$stmt->bindParam(15, $college, PDO::PARAM_STR,150);
		$stmt->bindParam(16, $bats, PDO::PARAM_STR,1);
		$stmt->bindParam(17, $throws, PDO::PARAM_STR,1);
		$stmt->bindParam(18, $mlb_image, PDO::PARAM_STR,25);
		$stmt->bindParam(19, $mlbid, PDO::PARAM_STR,11);

		// insert one row
		$player_id = $value->player->id;
		$first_name = $value->player->firstName;
		$last_name = $value->player->lastName;
		$position = $value->player->primaryPosition;
		$jersey_num = $value->player->jerseyNumber;
		if(isset($value->player->currentTeam->id)){
	        $team_id = $value->player->currentTeam->id;  
	    } else {
	    	$team_id = 0;
	    }
	    if(isset($value->player->currentTeam->abbreviation)){
	    	$team_abbr = $value->player->currentTeam->abbreviation;
	    } else {
	    	$team_abbr = '';
	    }
		$height = $value->player->height;
		$weight = $value->player->weight;
		$dob = $value->player->birthDate;
		$age = $value->player->age;
		$birth_city = $value->player->birthCity;
		$birth_country = $value->player->birthCountry;
		$high_school = $value->player->highSchool;
		$college = $value->player->college;
		$bats = $value->player->handedness->bats;
		$throws = $value->player->handedness->throws;
		
		if(isset($value->player->officialImageSrc)){
			$split_url = explode('//', $value->player->officialImageSrc);
			$pieces = explode('/', $split_url[1]);
			$num = (count($pieces) - 1);		
			$mlb_image = $pieces[$num];
		} else {
			$mlb_image = '';
		}

		foreach($value->player->externalMappings as $key2 => $value2){
	        $mlbid = $value2->id;
	    }		

		$stmt->execute();

	}


	curl_close($ch);

?>
