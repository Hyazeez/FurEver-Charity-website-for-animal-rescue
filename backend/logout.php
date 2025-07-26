<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login or home page
header("Location: index.html"); // Change this to your actual login page
exit();
?>
