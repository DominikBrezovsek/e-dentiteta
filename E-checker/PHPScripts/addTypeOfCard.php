<?php
session_start();
require_once '../vendor/autoload.php';
require_once 'conn.php';
require_once 'header.php';
require_once 'decodeToken.php';
require_once 'checkHeader.php';

if (isset($_SESSION['email']) && $token != null && isset($_FILES['img'])) {
    $image = $_FILES['img'];
    $nameOfCard = $_POST['name'];
    try {
        $stmt=$eid->prepare("INSERT INTO card_types VALUES (?, ?)");
        $name = uniqid() . ".png";
        $stmt->bind_param("ss", $nameOfCard, $name);
        $stmt->execute();

        move_uploaded_file($image['tmp_name'], __DIR__ . '/../../../e-dentiteta.usdd.company/images/' . $name);


        echo json_encode('File uploaded successfully');
        exit;

    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
        exit;
    }

}

?>