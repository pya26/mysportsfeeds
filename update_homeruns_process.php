<?php

  $date_string = $_POST["years"] . $_POST["months"] . $_POST["days"];
  $month_string = $_POST["months"];
  $day_string = $_POST["days"];
  $column_name = "day" . ltrim($day_string, '0');

  

  switch ($month_string) {
    case '01':
        $table_string = 'hrs_january';
        break;
    case '02':
        $table_string = 'hrs_february';
        break;
    case '03':
        $table_string = 'hrs_march';
        break;
    case '04':
        $table_string = 'hrs_april';
        break;
    case '05':
        $table_string = 'hrs_may';
        break;
    case '06':
        $table_string = 'hrs_june';
        break;
    case '07':
        $table_string = 'hrs_july';
        break;
    case '08':
        $table_string = 'hrs_august';
        break;
    case '09':
        $table_string = 'hrs_september';
        break;
    case '10':
          $table_string = 'hrs_october';
          break;
    case '11':
        $table_string = 'hrs_november';
        break;
    case '12':
        $table_string = 'hrs_december';
        break;
}


  try {
    include("_db_connect_string.php");
  } catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
  }


  // Get cURL resource
  $ch = curl_init();

  $url = 'https://api.mysportsfeeds.com/v2.1/pull/mlb/2019-regular/date/'. $date_string . '/player_gamelogs.json';

  // Set url
  curl_setopt($ch, CURLOPT_URL, $url);//?player=jd-martinez-10474

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


  foreach($response->gamelogs as $key => $value) {
    $id =  $value->player->id;
    $firstName =  $value->player->firstName;
    $lastName =  $value->player->lastName;
    $homeruns = $value->stats->batting->homeruns;
    //print $id . " - " . $firstName ." ". $lastName  . " - " . $homeruns . "</br>";

    $stmt = $dbh->prepare("UPDATE " . $table_string . " SET " . $column_name  . " = " .$homeruns ." WHERE player_id = ". $id ."");
    $stmt->execute();

    /*
    $stmt = $dbh->prepare("CALL update_april_homeruns(?)");
    $stmt->bindParam(1, $id, PDO::PARAM_INT, 11);
    $stmt->execute();*/
  }
  



  // Close request to clear up some resources
  curl_close($ch);


 header('Location: update_homeruns.php'); /* Redirect browser */
exit();



?>
