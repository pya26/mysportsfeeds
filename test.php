<?php


/*
$json = '{"1":"a","2":"b","3":"c","4":"d","5":"e"}';
 $obj = json_decode($json, TRUE);

foreach($obj as $key => $value)
{
echo 'Your key is: '.$key.' and the value of the key is:'.$value . "<br />";
}

*/


	try {
		include("config_files/_db_connect_string.php");
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		die();
	}

	$api_id = 20;
	$stmt = $dbh->prepare("SELECT m.* FROM rel_apis_api_params r JOIN msf_api_params m ON m.api_param_id = r.api_param_id WHERE r.api_id = ? ORDER BY m.api_param_name ASC");
	$stmt->bindParam(1, $api_id, PDO::PARAM_INT);
	$stmt->execute();
  

//print_r($stmt);
  
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	  print $row['api_param_name'] . ' -- ' . $row['api_param_filter'] . '<br />';
	}
    


?>
