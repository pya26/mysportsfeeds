<?php

// Get cURL resource
$ch = curl_init();

// Set url
curl_setopt($ch, CURLOPT_URL, 'https://api.mysportsfeeds.com/v2.1/pull/mlb/2019-regular/games.json');

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

foreach($response->games as $key => $value) {

	$start_time = $value->schedule->startTime;
	$start_time_pieces = explode("-",$start_time);
	$years = $start_time_pieces[0];
	$months = $start_time_pieces[1];
	$days = substr($start_time_pieces[2],0,2);

	$starttime = $years . $months . $days;

	$start_date_array[] = array('starttime' => $starttime);

	/*print $value->schedule->id . '<br />';
	print $value->schedule->startTime . '<br />';
	print $value->schedule->endedTime . '<br />';
	print $value->schedule->awayTeam->id . '<br />';
	print $value->schedule->awayTeam->abbreviation . '<br />';
	print $value->schedule->homeTeam->id . '<br />';
	print $value->schedule->homeTeam->abbreviation . '<br />';
	print $value->schedule->venue->id . '<br />';
	print $value->schedule->venue->name . '<br />';
	print $value->schedule->venueAllegiance . '<br />';
	print $value->schedule->scheduleStatus . '<br />';
	print $value->schedule->originalStartTime . '<br />';
	print $value->schedule->delayedOrPostponedReason . '<br />';
	print $value->schedule->playedStatus . '<br />';
	print $value->schedule->attendance . '<br />';
	print_r($value->schedule->officials) . '<br />';
	print_r($value->schedule->broadcasters) . '<br />';
	print $value->schedule->weather . '<br />==============================================<br /><br />';*/
	//print_r($value->schedule);

}


//print $start_date_array[0]['starttime'];

$result = $start_date_array;

print "<pre>";
print_r($result);
print "</pre>";

/*foreach($result as $key => $value){
	print $value['starttime']. '<br />';
}*/

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