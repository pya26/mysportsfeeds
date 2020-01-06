<?php

try {
	require "_config.php";
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
	die();
}



$header = "<!DOCTYPE html>";
$header .= "<html>";
$header .= "<head>";
$header .= "<title>MySportsFeeds API</title>";
$header .= '<script  src="https://code.jquery.com/jquery-3.4.1.min.js"  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>';
$header .= '<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">';
$header .= '<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>';
$header .= '<script  src="'.$BASE_URL.'js/scripts.js"></script>';
$header .= "</head>";
$header .= "<body>";

print $header;

?>