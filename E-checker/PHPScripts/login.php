<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: *");
require_once '../vendor/autoload.php';
include_once 'conn.php';
use Firebase\JWT\JWT;

if(!isset($_POST['username']) || !isset($_POST['password'])) {
    echo json_encode("False");
    $conn-> close();
    exit;
  }
$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT email FROM login WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows === 0) {
    echo json_encode("Invalid credentials.");
    $conn-> close();
    exit;
  }

$row = $result->fetch_assoc();
$_SESSION['email'] = $_POST['username'];
$email = $_POST['username'];
require_once "token.ini.php";

$stmt = $conn->prepare("INSERT INTO token VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $token_id, $issued_at, $expire, $email);
$stmt->execute();

$jwt = JWT::encode($payload, $secret, 'HS256', null, $header);
$data = array(
    "jwt" =>$jwt,
    "success" => "true"
);

echo json_encode($data);
$conn-> close();
exit;

?>