<?php

$server = 'localhost';
$username = 'root';
$password = '';
$db = 'test';

try {
  $con = new PDO("mysql:host=$server;dbname=$db", $username, $password);
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}

?>
