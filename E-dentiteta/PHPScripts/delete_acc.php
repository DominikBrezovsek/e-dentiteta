<?php
session_start();

require_once '../vendor/autoload.php';
require_once 'conn.php';
require_once 'header.php';
require_once 'checkHeader.php';
require_once 'decodeToken.php';

if (!isset($_POST['delete'])){
    echo json_encode("No delete sent");
    $conn->close();
    exit;
}
$email = $_SESSION['email'];

$stmt = $conn->prepare("DELETE FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$conn->close();
echo json_encode("true");
exit;
?>