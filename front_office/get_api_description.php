<?php

$api_id = $_GET['api_id'];

  /* Connect to a MySQL database using driver invocation */
  $dbname = 'homerunpool';
  $dbhost = 'localhost';
  $dsn = 'mysql:dbname=' . $dbname .';host=' . $dbhost .';';
  $user = 'root';
  $password = '';

  $dbh = new PDO($dsn, $user, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);


  $stmt = $dbh->prepare("SELECT api_desc FROM msf_apis WHERE api_id = ?");
  $stmt->bindParam(1, $api_id, PDO::PARAM_INT);
  $stmt->execute();

   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo json_encode(array('description' => $row['api_desc']));
  }






?>