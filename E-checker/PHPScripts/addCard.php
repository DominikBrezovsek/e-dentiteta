<?php
session_start();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: *");

require_once '../vendor/autoload.php';
require_once 'conn.php';
require_once 'header.php';
require_once 'decodeToken.php';
require_once 'checkHeader.php';

if (isset($_SESSION['email']) && $token != null) {
        
    
    $DOE = $_POST['DOE'];
    $type = $_POST['type'];
    $user = $_POST['user'];
    $image = $_POST['image'];   
    $mail = "";
    $name = "";
    $surname = "";

    $credentials = $eid->prepare("SELECT email, name, surname FROM user WHERE  email = ?");
    $credentials-> bind_param('s', $user);
    $credentials->execute();
    $result = $credentials->get_result();

    if(mysqli_num_rows($result) > 0){
        while($data = $result->fetch_assoc()){
            $mail = $data['email'];
            $name = $data['name'];
            $surname = $data['surname'];
        }
    }
    $issuer = $conn->prepare("SELECT s.school_id FROM user u JOIN school s ON u.school_id = s.school_id WHERE  email = ?");
    $issuer-> bind_param('s', $_SESSION['email']);
    $issuer->execute();
    $result = $issuer->get_result();
    $data = $result->fetch_assoc();
    $org = $data['school_id'];

    $stmt = $eid->prepare("INSERT INTO card (type, date_of_expiration, issued_at, issuer, owner) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $type, $DOE, $issued_at, $org, $mail);
    $stmt->execute();

    $conn->close();
    $eid->close();
    echo json_encode("true");
    exit;

    }

?>