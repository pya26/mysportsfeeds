<?php

// Get cURL resource
$ch = curl_init();

// Set url
curl_setopt($ch, CURLOPT_URL, "https://api.mysportsfeeds.com/v1.0/pull/mlb/2019-regular/cumulative_player_stats.json?limit=1");
// Set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

// Set options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Set compression
curl_setopt($ch, CURLOPT_ENCODING, "gzip");

// Set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
	"Authorization: Basic " . base64_encode("3e610f3c-19bb-400c-b0b6-887575" . ":" . "AaronNolan26")
]);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Send the request & save response to $resp
$resp = curl_exec($ch);
$response = json_decode($resp);

/*
if (!$resp) {
	die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
} else {
	echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
	echo "\nResponse HTTP Body : " . $resp;
}*/

/*foreach($response->dailyplayerstats->playerstatsentry as $key => $value) {
 $player_id = $value->player->ID;
 print 'Player ID'. $player_id . '<br />';
 print 'HR\'s' . $value->stats->Homeruns->{'#text'} .'<br /><br />';
}*/

print"<pre>";
print_r($response);
print"</pre>";


/*
foreach($response->players as $key => $value) {
 $player_id = $value->player->ID;
 $homeruns = $value->stats->Homeruns->#text
}*/

// Close request to clear up some resources
curl_close($ch);

?>