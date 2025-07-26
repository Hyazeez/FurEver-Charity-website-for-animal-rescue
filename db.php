<?php
$host = "localhost";
$username = "your_host_username";
$password = "your_host_password";
$database = "your_host_db_name";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>