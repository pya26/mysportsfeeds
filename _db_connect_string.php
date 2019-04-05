<?php

  /* Connect to a MySQL database using driver invocation */
  $dbname = 'homerunpool';
  $dbhost = 'localhost';
  $dsn = 'mysql:dbname=' . $dbname .';host=' . $dbhost .';';
  $user = 'root';
  $password = '';

  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

?>