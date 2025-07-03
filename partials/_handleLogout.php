<?php
session_start();

$redirect = isset($_POST['redirect_to']) ? $_POST['redirect_to'] : '/forum/index.php';
$separator = (parse_url($redirect, PHP_URL_QUERY)) ? '&' : '?';
// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

header("location:" . $redirect . $separator . "logout=true");
exit();
