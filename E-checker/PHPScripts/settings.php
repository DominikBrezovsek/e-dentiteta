<?php
session_start();
require_once '../vendor/autoload.php';
require_once 'conn.php';
require_once 'header.php';
require_once 'decodeToken.php';
require_once 'checkHeader.php';
if (isset($_SESSION['email'])) {

    $user_array = array(); // Create an empty array to hold the card objects
    $user_data = new stdClass();
    $user_data->email = $_SESSION['email'];
    $user_array[] = $user_data; // Add the card object to the array
    $json = json_encode($user_array);
    echo $json;
    exit;

}

?>