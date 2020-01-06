<?php

// Get cURL resource
$ch = curl_init();

// Set url
curl_setopt($ch, CURLOPT_URL, 'https://api.mysportsfeeds.com/v2.1/pull/mlb/2019-regular/venues.json');

// Set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

// Set options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Set compression
curl_setopt($ch, CURLOPT_ENCODING, "gzip");

// Set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
	"Authorization: Basic " . base64_encode("3e610f3c-19bb-400c-b0b6-887575" . ":" . "MYSPORTSFEEDS")
]);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Send the request & save response to $resp
$resp = curl_exec($ch);

$response = json_decode($resp);

/*
print"<pre>";
print_r($response);
print"</pre>";
*/




foreach($response->venues as $key => $value) {

	$venue_id = $value->venue->id;
	$venue_name = $value->venue->name;
	$venue_city = $value->venue->city;
	$venue_country = $value->venue->country;
	$venue_latitude = $value->venue->geoCoordinates->latitude;
	$venue_longitude = $value->venue->geoCoordinates->longitude;
	$venue_event_type = $value->venue->capacitiesByEventType[0]->eventType;
	$venue_event_capacity = $value->venue->capacitiesByEventType[0]->capacity;
	$venue_playing_surface = $value->venue->playingSurface;

	if (!empty($value->venue->hasRoof)) {
		$venue_hasRoof = $value->venue->hasRoof;
	} else {
		$venue_hasRoof = 'No roof';	
	}

	if (!empty($value->venue->hasRetractableRoof)) {
		$venue_retractable_roof = $value->venue->hasRetractableRoof;
	} else {
		$venue_retractable_roof = 'No retractable roof';
	}

	if (!empty($value->homeTeam->id)) {
		$venue_home_team_id = $value->homeTeam->id;
	} else {
		$venue_home_team_id = 'No home team id';
	}

	if (!empty($value->homeTeam->city)) {
		$venue_home_team_city = $value->homeTeam->city;
	} else {
		$venue_home_team_city = 'No home team city';
	}

	if (!empty($value->homeTeam->name)) {
		$venue_home_team_name = $value->homeTeam->name;
	} else {
		$venue_home_team_name = 'No home team name';
	}

	if (!empty($value->homeTeam->abbreviation)) {
		$venue_home_team_abbr = $value->homeTeam->abbreviation;
	} else {
		$venue_home_team_abbr = 'No home team abbreviation';
	}

	if (!empty($value->homeTeam->homeVenue->id)) {
		$venue_home_team_venue_id = $value->homeTeam->homeVenue->id;
	} else {
		$venue_home_team_venue_id = 'No home team venue id';
	}
	
	
	
	
	
	
	
	

	print $venue_id . '<br />';
	print $venue_name . '<br />';
	print $venue_city . ' ' . $venue_country . '<br />';
	print $venue_latitude . ' ' . $venue_longitude . '<br />';
	print $venue_event_type . '<br />';
	print $venue_event_capacity . '<br />';
	print $venue_playing_surface . '<br />';

	
	print $venue_hasRoof . '<br />';
	print $venue_retractable_roof . '<br />';
	print $venue_home_team_id . '<br />';
	print $venue_home_team_city . '<br />';
	print $venue_home_team_name . '<br />';
	print $venue_home_team_abbr . '<br />';
	print $venue_home_team_venue_id . '<br />';
	print '<br /><br />';


	/*foreach($value->venue->capacitiesByEventType as $key2 => $value2){
		print "<pre>";
		print_r($value2->eventType);
		print "</pre>";
	}

	print "<pre>";
	print_r($value->venue->capacitiesByEventType[0]->eventType);
	print "</pre>";
	*/
}



/*
if (!$resp) {
	die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
} else {
	echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
	echo "\nResponse HTTP Body : " . $resp;
}
*/

// Close request to clear up some resources
curl_close($ch);

?>