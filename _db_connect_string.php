<?php

  /* Connect to a MySQL database using driver invocation */
  $dbname = 'homerunpool';
  $dbhost = 'localhost';
  $dsn = 'mysql:dbname=' . $dbname .';host=' . $dbhost .';';
  $user = 'root';
  $password = '';

  $dbh = new PDO($dsn, $user, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

?>