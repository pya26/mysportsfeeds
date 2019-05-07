<?php

	require '_config.php';

	// Get cURL resource
	$ch = curl_init();

	$feed_url = '';

	// Set url
	curl_setopt($ch, CURLOPT_URL, $feed_url);
	//?season=2019-regular&rosterstatus=assigned-to-roster,assigned-to-injury-list&position=C,1B,2B,3B,SS,LF,CF,RF
	//rosterstatus=assigned-to-roster,assigned-to-injury-list&position=C,1B,2B,3B,SS,LF,CF,RF
	//player=jd-martinez
	//?player=mookie-betts-10303
	//?position=C,1B,2B,3B,SS,LF,CF,RF
	//?player=11249,10277,11487,11099,10334,11249,12067,11671,trea-turner

	// Set method
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

	// Set options
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	// Set compression
	curl_setopt($ch, CURLOPT_ENCODING, "gzip");

	// Set headers
	$headers = array(
	    'Content-type: application/json; charset=UTF-8',
	    "Authorization: Basic " . base64_encode($mysportsfeeds_apikey_token . ":" . $mysportsfeeds_password),
	);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	// Send the request & save response to $resp
	$resp = curl_exec($ch);

	/*
	if (!$resp) {
		die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
	} else {
		echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
		echo "\nResponse HTTP Body : " . $resp;
	}
	*/

	$response = json_decode($resp);

	// Close request to clear up some resources
	curl_close($ch);

?