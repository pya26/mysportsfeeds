<?php

  $date_string = $_POST["years"] . $_POST["months"] . $_POST["days"];
  $month_string = $_POST["months"];
  $day_string = $_POST["days"];
  $column_name = "day" . ltrim($day_string, '0');

  

  switch ($month_string) {
    case '01':
        $table_string = 'hrs_january';
        $hr_totals_stored_proc = 'update_january_homerun_totals';
        break;
    case '02':
        $table_string = 'hrs_february';
        $hr_totals_stored_proc = 'update_february_homerun_totals';
        break;
    case '03':
        $table_string = 'hrs_march';
        $hr_totals_stored_proc = 'update_march_homerun_totals';
        break;
    case '04':
        $table_string = 'hrs_april';
        $hr_totals_stored_proc = 'update_april_homerun_totals';
        break;
    case '05':
        $table_string = 'hrs_may';
        $hr_totals_stored_proc = 'update_may_homerun_totals';
        break;
    case '06':
        $table_string = 'hrs_june';
        $hr_totals_stored_proc = 'update_june_homerun_totals';
        break;
    case '07':
        $table_string = 'hrs_july';
        $hr_totals_stored_proc = 'update_july_homerun_totals';
        break;
    case '08':
        $table_string = 'hrs_august';
        $hr_totals_stored_proc = 'update_august_homerun_totals';
        break;
    case '09':
        $table_string = 'hrs_september';
        $hr_totals_stored_proc = 'update_september_homerun_totals';
        break;
    case '10':
          $table_string = 'hrs_october';
          $hr_totals_stored_proc = 'update_october_homerun_totals';
          break;
    case '11':
        $table_string = 'hrs_november';
        $hr_totals_stored_proc = 'update_november_homerun_totals';
        break;
    case '12':
        $table_string = 'hrs_december';
        $hr_totals_stored_proc = 'update_december_homerun_totals';
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

    $stmt = $dbh->prepare("CALL ". $hr_totals_stored_proc . "(?)");
    $stmt->bindParam(1, $id, PDO::PARAM_INT, 11);
    $stmt->execute();
  }
  



  // Close request to clear up some resources
  curl_close($ch);


 header('Location: update_homeruns.php?month='.$_POST["months"].'&day='.$_POST["days"].'&year='.$_POST["years"]); /* Redirect browser */
exit();


?>
