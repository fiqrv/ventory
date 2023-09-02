<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['HTTP_HOST'] === 'localhost') {
    $HOSTNAME = 'localhost';
    $USERNAME = 'root';
    $PASSWORD = '';
    $DATABASE = 'ventory2';
} else {
    $HOSTNAME = 'LIVE_SERVER_HOSTNAME';
    $USERNAME = 'LIVE_SERVER_USERNAME';
    $PASSWORD = 'LIVE_SERVER_PASSWORD';
    $DATABASE = 'LIVE_SERVER_DATABASE';
}

$conn = new mysqli($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
