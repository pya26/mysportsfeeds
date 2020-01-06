<?php


	function dynamic_select($the_array, $element_name, $label = '', $init_value = '') {
	    $menu = '';
	    if ($label != '') $menu .= '
	    	<label for="'.$element_name.'">'.$label.'</label>';
	    $menu .= '
	    	<select name="'.$element_name.'" id="'.$element_name.'">';
	    if (empty($_REQUEST[$element_name])) {
	        $curr_val = $init_value;
	    } else {
	        $curr_val = $_REQUEST[$element_name];
	    }
	    /*
	    foreach ($the_array as $key => $value) {
	        $menu .= '
				<option value="'.$key.'"';
	        if ($key == $curr_val) $menu .= ' selected="selected"';
	        $menu .= '>'.$value.'</option>';
	    }*/
	    /**
	     * Change the foreach loop to a for loop to itterate through the multidimensional array
	     */
	    $menu .= '<option value="">--- Select an API ---</option>';
	    for ($i = 0; $i < count($the_array); $i++) {
	    	$menu .= '<option value="'.$the_array[$i]['api_id'].'"';
	        if ($the_array[$i]['api_id'] == $curr_val) $menu .= ' selected="selected"';
	        $menu .= '>'.$the_array[$i]['api_name'].'</option>';	
	    }
	    $menu .= '
	    	</select>';
	    return $menu;
	}




	function api_param_select() {
		/*var value = $('#globalstyleselect').val();
		var div = $("#stylediv");
		if (value == "3") {
			div.html('<b>Boca Style</b>');
		}
		if (value == "2") {
			div.html('<b>Bella Style</b>');
		}
		if (value == "1") {
			div.html('<b>Terra Style</b>');
		}*/
		try {
			require "../config_files/_db_connect_string.php";
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
			die();
		}

	}




	function get_api_and_params($api_id){


		try {
			require "../config_files/_db_connect_string.php";
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
			die();
		}

		$api_url_query = $dbh->prepare("SELECT api_name, api_url, api_desc  FROM msf_apis WHERE api_id = ?");
		$api_url_query->bindParam(1, $api_id, PDO::PARAM_INT);
		$api_url_query->execute();

		$api_url_array = [];
		while ($row = $api_url_query->fetch(PDO::FETCH_ASSOC)) {
			//$api_url = $row['api_url'];
			$api_url_array = ['api_name' => $row['api_name'],'api_url' => $row['api_url'],'api_desc' => $row['api_desc']];
			//$associativeArray[$row['month']] = $row['salary'];
			//$aMemberships[$aMemb['ID']] = $aMemb['Name'];
		}


		$api_params_query = $dbh->prepare("SELECT m.* FROM rel_apis_api_params r JOIN msf_api_params m ON m.api_param_id = r.api_param_id WHERE r.api_id = ? ORDER BY m.api_param_name ASC");
		$api_params_query->bindParam(1, $api_id, PDO::PARAM_INT);
		$api_params_query->execute();

		$api_params_array = [];
		while ($row = $api_params_query->fetch(PDO::FETCH_ASSOC)) {
		  //print $row['api_param_name'] . ' -- ' . $row['api_param_filter'] . '<br />';
		  //$api_params_array = ['api_param_name' => $row['api_param_name'], 'api_param_filter' => $row['api_param_filter']];
		  //$api_params_array[$row['api_param_name']] = $row['api_param_filter'];
			$api_params_array[$row['api_param_name'][0]][] = $row;
		}

		/*$stmt = $dbh->prepare("SELECT m.* FROM rel_apis_api_params r JOIN msf_api_params m ON m.api_param_id = r.api_param_id WHERE r.api_id = ? ORDER BY m.api_param_name ASC");
		$stmt->bindParam(1, $api_id, PDO::PARAM_INT);
		$stmt->execute();


		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_ENCODING, "gzip");
		$headers = array(
		    'Content-type: application/json; charset=UTF-8',
		    "Authorization: Basic " . base64_encode("3e610f3c-19bb-400c-b0b6-887575" . ":" . "MYSPORTSFEEDS"),
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$resp = curl_exec($ch);
		$response = json_decode($resp);

		curl_close($ch);*/

		return array_merge($api_url_array, $api_params_array);

	}





?>


