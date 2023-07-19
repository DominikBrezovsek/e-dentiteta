<?php
session_start();
require_once '../vendor/autoload.php';
include_once 'conn.php';

if (!isset($_SESSION['email']) && $authorization == '') {
    echo json_encode("false");
    exit;
}
$email = $_SESSION['email'];
require_once 'decodeToken.php';
$new_password = $_POST['newPassword'];
$stmt = $conn->prepare("UPDATE login SET password = ? WHERE email = ?");
$stmt->bind_param('ss', $new_password, $email);
$stmt->execute();
echo json_encode("true");
exit;

?>