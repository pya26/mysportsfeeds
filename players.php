<?php

// Get cURL resource
$ch = curl_init();

// Set url
curl_setopt($ch, CURLOPT_URL, "https://api.mysportsfeeds.com/v2.1/pull/mlb/players.json?rosterstatus=assigned-to-roster,assigned-to-injury-list&position=C,1B,2B,3B,SS,LF,CF,RF");
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
    "Authorization: Basic " . base64_encode("3e610f3c-19bb-400c-b0b6-887575" . ":" . "MYSPORTSFEEDS"),
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Send the request & save response to $resp
$resp = curl_exec($ch);
$response = json_decode($resp);
/*
print"<pre>";
print_r($response);
print"</pre>";
*/
/*
if (!$resp) {
	die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
} else {
	echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
	echo "\nResponse HTTP Body : " . $resp;
}
*/

/*
print"<pre>";
print_r(curl_getinfo($ch));
print"</pre>";
*/

// Close request to clear up some resources
/*
print "<br />XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
print "<br />";
//print $response->lastUpdatedOn;
//print_r($response->players);
print "ID: ".$response->players[0]->player->id;
print "<br />";
print "First Name : ".$response->players[0]->player->firstName;
print "<br />";
print "Last Name : ".$response->players[0]->player->lastName;
print "<br />";
print "Primary Position : ".$response->players[0]->player->primaryPosition;
print "<br />";
print "Jersey Number : ".$response->players[0]->player->jerseyNumber;
print "<br />";
print "Current Team ID : ".$response->players[0]->player->currentTeam->id;
print "<br />";
print "Current Team Abbreviation : ".$response->players[0]->player->currentTeam->abbreviation;
print "<br />";
print "Current Roster Status : ".$response->players[0]->player->currentRosterStatus;
print "<br />";
print "Current Injury : ".$response->players[0]->player->currentInjury;
print "<br />";
print "Height : ".$response->players[0]->player->height;
print "<br />";
print "Weight : ".$response->players[0]->player->weight;
print "<br />";
print "Birth Date : ".$response->players[0]->player->birthDate;
print "<br />";
print "Age : ".$response->players[0]->player->age;
print "<br />";
print "Birth City : ".$response->players[0]->player->birthCity;
print "<br />";
print "Birth Country : ".$response->players[0]->player->birthCountry;
print "<br />";
print "Rookie : ".$response->players[0]->player->rookie;
print "<br />";
print "High School : ".$response->players[0]->player->highSchool;
print "<br />";
print "College : ".$response->players[0]->player->college;
print "<br />";
print "Bats : ".$response->players[0]->player->handedness->bats;
print "<br />";
print "Throws : ".$response->players[0]->player->handedness->throws;
print "<br />";
print "<img src=".$response->players[0]->player->officialImageSrc.">";
print "<br />";
print "Social Media Accounts : ".$response->players[0]->player->socialMediaAccounts[0]->mediaType . " -- " . $response->players[0]->player->socialMediaAccounts[0]->value;
print "<br />";
print "Contract Year : ".$response->players[0]->player->currentContractYear;
print "<br />";
print "Year Drafted : ".$response->players[0]->player->drafted->year;
print "<br />";
print "Drafted By : ".$response->players[0]->player->drafted->pickTeam->id ." -- " . $response->players[0]->player->drafted->pickTeam->abbreviation;
print "<br />";
print "Draft Round : ".$response->players[0]->player->drafted->round;
print "<br />";
print "Round Pick : ".$response->players[0]->player->drafted->roundPick;
print "<br />";
print "Overall Pick : ".$response->players[0]->player->drafted->overallPick;
print "<br />";
print "MLB.org ID: ".$response->players[0]->player->externalMappings[0]->id;
print "<br />";
print "Team as of today : ".$response->players[0]->teamAsOfDate->abbreviation;

*/

foreach($response->players as $key => $value) {

  //if($value->player->primaryPosition != 'P'){
    $data = $key . "<br />";
    $data .= $value->player->id . "<br />";
    $data .= $value->player->firstName . "<br />";
    $data .= $value->player->lastName . "<br />";
    $data .= "Primary Position : ".$value->player->primaryPosition . "<br />";
    $data .= "Jersey Number : ".$value->player->jerseyNumber . "<br />";
    if(isset($value->player->currentTeam->id)){
        $data .= "Current Team ID : ".$value->player->currentTeam->id . "<br />";  
    }
    //$data .="Current Team Abbreviation : ".$value->player->currentTeam->abbreviation . "<br />";
    $data .= "Current Roster Status : ".$value->player->currentRosterStatus . "<br />";
    //$data .= "Current Injury : ".$value->player->currentInjury . "<br />";
    $data .= "Height : ".$value->player->height . "<br />";
    $data .= "Weight : ".$value->player->weight . "<br />";
    $data .= "Birth Date : ".$value->player->birthDate . "<br />";
    $data .= "Age : ".$value->player->age . "<br />";
    $data .= "Birth City : ".$value->player->birthCity . "<br />";
    $data .= "Birth Country : ".$value->player->birthCountry . "<br />";
    $data .= "Rookie : ".$value->player->rookie . "<br />";
    $data .= "High School : ".$value->player->highSchool . "<br />";
    $data .= "College : ".$value->player->college . "<br />";
    $data .= "Bats : ".$value->player->handedness->bats . "<br />";
    $data .= "Throws : ".$value->player->handedness->throws . "<br />";
    $data .= "<img src=".$value->player->officialImageSrc . "><br />";
    //$data .= "Social Media Accounts : ".$value->player->socialMediaAccounts[0]->mediaType . " -- " . $value->player->socialMediaAccounts[0]->value . "<br />";
    //$data .= "Contract Year : ".$value->player->currentContractYear . "<br />";
    //$data .= "Year Drafted : ".$value->player->drafted->year . "<br />";
    //$data .= "Drafted By : ".$value->player->drafted->pickTeam->id ." -- " . $value->player->drafted->pickTeam->abbreviation . "<br />";
    //$data .= "Draft Round : ".$value->player->drafted->round . "<br />";
    //$data .= "Round Pick : ".$value->player->drafted->roundPick . "<br />";
    //$data .= "Overall Pick : ".$value->player->drafted->overallPick . "<br />";
    foreach($value->player->externalMappings as $key2 => $value2){
        $data .= "MLB.org ID: ".$value2->id . "<br />";
    }
    
    //$data .= "Team as of today : ".$response->players[0]->teamAsOfDate->abbreviation;

    print $data . "<br /><br />";
  //}



}



curl_close($ch);

?>
