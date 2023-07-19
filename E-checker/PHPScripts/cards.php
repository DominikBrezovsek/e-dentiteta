<?php
session_start();
require_once '../vendor/autoload.php';
require_once 'conn.php';
require_once 'header.php';
require_once 'decodeToken.php';
require_once 'checkHeader.php';


if (!isset($_SESSION['email'])) {
    echo json_encode("session not set");
    $conn-> close();
    $eid->close();
    exit;
}
    $tip = $eid->prepare("SELECT card_type,image FROM card_types WHERE 1=1");
    $tip->execute();
    $result = $tip->get_result();
    $card_array = array();
    if (mysqli_num_rows($result) > 0) {
        while ($data = $result->fetch_assoc()) {
            $card = new stdClass();
            $name = $data['card_type'];
            $image = $data['image'];
            $card->tip = $name;
            $card->image = $image;
            $card_array[] = $card; // Add the card object to the array
        }
        $response = new stdClass();
        $response->object = $card_array;
        $json = json_encode($response);
        echo $json;
        exit;

    }
    else{
        echo json_encode("No cards");
        $conn-> close();
        $eid->close();
        exit;
    }
?>