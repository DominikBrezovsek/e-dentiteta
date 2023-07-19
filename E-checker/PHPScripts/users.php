<?php
session_start();
require_once '../vendor/autoload.php';
require_once 'conn.php';
require_once 'header.php';
require_once 'decodeToken.php';
require_once 'checkHeader.php';

if (isset($_SESSION['email']) && isset($_POST['search'])) {
    $mail = "%{$_POST['search']}%";
    $credentials = $eid->prepare("SELECT email FROM user WHERE email LIKE ?");
    $credentials->bind_param("s", $mail);
    $credentials->execute();
    $result = $credentials->get_result();
    $card_array = array();
    if (mysqli_num_rows($result) > 0) {
        while ($data = $result->fetch_assoc()) {
            $card = new stdClass();
            $email = $data['email'];
            $card->user = $email;
            $card_array[] = $card; // Add the card object to the array
        }
        $response = new stdClass();
        $response->object = $card_array;
        $json = json_encode($response);
        echo $json;
        exit;
    }
    else{
        echo json_encode("Idiot si!");
    }
} else {
    echo json_encode("Ni headerjev tralala");
}
?>