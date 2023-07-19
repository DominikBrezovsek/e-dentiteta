<?php
session_start();

require_once 'header.php';
include_once 'conn.php';
require_once '../vendor/autoload.php';

require_once "checkHeader.php";

if (isset($_SESSION['email']) && $token != null) {
    $email = $_SESSION['email'];
    require_once "decodeToken.php";
    // Connect to MySQL database

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        exit;
    }

    $user = $conn->prepare("SELECT name, surname FROM user WHERE email = ? ");
    $user->bind_param('s', $email);
    $user->execute();
    $result_user = $user->get_result();
    $user_array = array();

    if (mysqli_num_rows($result_user) > 0) {
        $data = $result_user->fetch_assoc();
        $user_data = new stdClass();
        $user_data->name = $data['name'];
        $user_data->surname = $data['surname'];
        $user_array[] = $user_data;
    }
} else {
    echo json_encode("False");
    exit;
}


$cards = $conn->prepare("SELECT * FROM card WHERE owner = ?");
$cards->bind_param('s', $email);
$cards->execute();
$result = $cards->get_result();

$card_array = array(); // Create an empty array to hold the card objects

if (mysqli_num_rows($result) > 0) {
    while ($data = $result->fetch_assoc()) {
        $card = new stdClass();
        $card->id = $data['card_id'];
        $card->naslov = $data['type'];
        $card->pot = "https://e-dentiteta.zanurban.si/images/" . $data['image'];
        $card_array[] = $card; // Add the card object to the array
    }
    $response = new stdClass();
    $response->user = $user_array;
    $response->object = $card_array;
    $json = json_encode($response);
    echo $json;
    exit;
} else {
    $response = new stdClass();
    $response->user = $user_array;
    $json = json_encode($response);
    echo $json;
    exit;
}
?>