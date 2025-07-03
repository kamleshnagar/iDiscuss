<?php
session_start();

$redirect = isset($_POST['redirect_to']) ? $_POST['redirect_to'] : '/forum/index.php';
$separator = (parse_url($redirect, PHP_URL_QUERY)) ? '&' : '?';


session_unset();       
session_destroy();    


session_start();        
$_SESSION['logout'] = true;


header("Location: " . $redirect . $separator . "logout=true");
exit();
?>
