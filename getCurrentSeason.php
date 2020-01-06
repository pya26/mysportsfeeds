<?php

try {
	require "config_files/_config.php";
	require "config_files/_db_connect_string.php";
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
	die();
}

// Get cURL resource
$ch = curl_init();

// Set url
curl_setopt($ch, CURLOPT_URL, 'https://api.mysportsfeeds.com/v2.1/pull/mlb/current_season.json?date=20171003');//&force=false

// Set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

// Set options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Set compression
curl_setopt($ch, CURLOPT_ENCODING, "gzip");

// Set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
	"Authorization: Basic " . base64_encode($mysportsfeeds_apikey_token . ":" . $mysportsfeeds_password)
]);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Send the request & save response to $resp
$resp = curl_exec($ch);

$response = json_decode($resp);

print "<pre>";
print_r($response);
print "</pre>";

if(!empty($response->seasons)){
	/*
	print"<pre>";
	print_r($response);
	print"</pre>";
	*/
	
	/*
	$stmt = $dbh->prepare("INSERT INTO lkp_seasons (name,slug,start_date,end_date,season_interval) VALUES (?,?,?,?,?)");//,interval
	$stmt->bindParam(1, $name, PDO::PARAM_STR, 15);
	$stmt->bindParam(2, $slug, PDO::PARAM_STR, 15);
	$stmt->bindParam(3, $start_date, PDO::PARAM_STR);
	$stmt->bindParam(4, $end_date, PDO::PARAM_STR);
	$stmt->bindParam(5, $interval, PDO::PARAM_STR, 25);		

	$name = $response->seasons[0]->name;
	$slug = $response->seasons[0]->slug;
	$s_date = $response->seasons[0]->startDate;
	$start_date = date("Y-m-d",strtotime($s_date));
	$e_date = $response->seasons[0]->endDate;
	$end_date = date("Y-m-d",strtotime($e_date));
	$interval = $response->seasons[0]->seasonInterval;

	$stmt->execute();

	$display = $name.'<br />';
	$display .= $slug.'<br />';
	$display .= date("Y-m-d",strtotime($start_date)).'<br />';
	$display .= date("Y-m-d",strtotime($end_date)).'<br />';
	$display .= $end_date.'<br />';
	$display .= $interval.'<br />';

	print $display;
	*/

} else {
	print "it's empty";
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