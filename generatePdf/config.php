<?php
$servername = "localhost";
$username = "u445806455_bmis";
$password = "DanDuarte123";
$dbname = "u445806455_bmis";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}
?>
