<?php

$host = 'Localhost';
$user_name = 'root';
$password = '';
$db_name = 'to_do_list';

$conn = new mysqli($host, $user_name, $password, $db_name);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}