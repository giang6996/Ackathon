<?php
require_once("settings.php");

$conn = @mysqli_connect($host, $user, $pwd, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}