<?php
// start session
session_start();

// unset all session variables
$_SESSION = array();

// destroy the session
session_destroy();

// redirect to login.php
header('Location: ../login.php');
exit();
