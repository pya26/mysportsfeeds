<?php

	try {
			require '../config_files/_header.php';
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
			die();
		}
	
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

/*
print $_SERVER['REQUEST_METHOD'];
print "<br />";
print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
	print "hello Trebek";
	print "<br />";
	print_r($_POST);
}
*/
		

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
	//$api_form = '<form id="api_params_select" action="'.$_SERVER['PHP_SELF'].'" method="POST">';
	$api_form = dynamic_select($api_array, 'api_menu', 'API Names:', '');
	/*$api_form .= '<input type="submit">';*/
	//$api_form .= '</form>';

	print $api_form;


	print '<div class="result"></div>';

	/*
	$result = $dbh->query("SELECT * FROM msf_api_params");
	$result->execute();
	$api_param_array = [];
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		//$api_array[$row['api_id']] = $row['api_name'];
		$api_param_array[] = ['api_param_id' => $row['api_param_id'], 'api_param_name' => $row['api_param_name'], 'api_param_filter' => $row['api_param_filter']];

		echo "<input type='checkbox' value='{$row['api_param_id']}'>" . $row['api_param_name'] . " - " .$row['api_param_filter']. '</br>';
	}
	*/

	
/*
	print "<pre>";
	print_r($api_param_array);
	print "</pre>";
	*/

	/*
$arr=array('a','b','c','d','e','f','g','h');
print_r(array_chunk($arr,2));
print "<br />";
print_r($arr);
exit();

$offset = 0; 
$num_columns = 2; //adjust number of columns
$table_html = "<table border='1'>";
while($slice = array_slice($arr,$offset,$num_columns)){
    $offset += $num_columns;
    $row_html = '';
    foreach($slice as $n) $row_html .= "<td>$n</td>";
    $table_html .= "<tr>$row_html</tr>";
}
$table_html .= '</table>';
echo $table_html;
*/



try {
			require '../config_files/_footer.php';
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
			die();
		}	

	
	


?>

