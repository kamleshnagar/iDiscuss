<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

header("Location: /forum/index.php?logout=true");
exit;
?>