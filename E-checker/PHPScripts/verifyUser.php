<?php
session_start();
require_once '../vendor/autoload.php';
require_once 'conn.php';
require_once 'header.php';
require_once 'decodeToken.php';
require_once 'checkHeader.php';

if(isset($_SESSION['email']) && isset($_POST["id"]) && isset($_POST["lid"]) && isset($_POST["cid"])){
    $lid=$_POST["lid"];
    $cid=$_POST["cid"];
    $id=$_POST["id"];
    $tip = $eid->prepare("SELECT name, surname, owner, username FROM login l JOIN user u
    ON l.email = u.email JOIN card c 
    ON u.email = c.owner JOIN qr_check q
    ON c.card_id = q.card_id WHERE q.link_id = ?
    AND q.token_id = ?
    AND q.card_id = ?");
    $tip->bind_param("sss", $lid, $id, $cid);
    $tip->execute();
    $result = $tip->get_result();
    $card_array = array();
    if (mysqli_num_rows($result) > 0) {
        while ($data = $result->fetch_assoc()) {
            $card = new stdClass();
            $name = $data['name'];
            $surname = $data['surname'];
            $owner = $data['owner'];
            $username = $data['username'];
            $card->name = $name;
            $card->surname = $surname;
            $card->email = $owner;
            $card->username = $username;
            $card_array[] = $card; // Add the card object to the array
        }
        $response = new stdClass();
        $response->object = $card_array;
        $json = json_encode($card_array);
        echo $json;
        exit;
    }
    else{
        echo json_encode("Idiot si!");
    }
}
?>