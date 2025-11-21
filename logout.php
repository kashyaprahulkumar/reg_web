<?php
// Start the session (it's in config.php, but good to be explicit here)
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: login.php");
exit;
?>