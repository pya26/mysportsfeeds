<?php

	/**
	 * Include file for msf api token
	 */
	/*
	try {
			require '../config_files/_config.php';
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
			die();
		}
	*/
	/**
	 * Include file for db connection string
	 */
	try {
			require "../config_files/_db_connect_string.php";
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
			die();
		}

	try {
			require "../includes/functions.php";
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
			die();
		}

		print_r($_POST);

	/**
	 * select all msf apis from db table, create assoc array with id and name
	 */
	$result = $dbh->query("SELECT * FROM msf_apis");
	$result->execute();	
	
	$api_array = array(''=>'--- Select an API ---');
	$api_array = [];
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		//$api_array[$row['api_id']] = $row['api_name'];
		$api_array[] = ['api_id' => $row['api_id'], 'api_name' => $row['api_name'], 'api_url' => $row['api_url'], 'api_desc' => $row['api_desc']];
	}



	/**
	 * display select menu of msf api names
	 */
	$api_form = '<form action="'.$_SERVER['PHP_SELF'].'" method="POST">';
	$api_form .= dynamic_select($api_array, 'api_menu', 'API Names:', '');
	$api_form .= '<input type="submit">';
	$api_form .= '</form>';

	print $api_form;





	
	


?>