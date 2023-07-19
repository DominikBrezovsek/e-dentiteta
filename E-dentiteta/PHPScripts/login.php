<?php
session_start();
/* include all of the necessary files for headers and database connection */
require_once 'header.php';
include_once 'conn.php';
require_once '../vendor/autoload.php';

/* use JWT library */
use Firebase\JWT\JWT;
// Check connection to database
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  exit;
}
/* if the username and password are not set, we return false */
if(!isset($_POST['username']) || !isset($_POST['password'])) {
  echo json_encode("False");
  exit;
}
/* if the username and password are set, we check if the user exists in the database */
$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT email FROM login WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();
/* if the user does not exist, we return false */
if($result->num_rows === 0) {
  echo json_encode("Invalid credentials.");
  exit;
}
/* if the user exists, we create a token and return it to the user */
$row = $result->fetch_assoc();
$_SESSION['email'] = $row['email'];
$email = $row['email'];
require_once 'token.ini.php';
/* we insert data that will be written in token  into the database*/
$stmt = $conn->prepare("INSERT INTO token VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $token_id, $issued_at, $expire, $email);
$stmt->execute();

/* we create the token */
$jwt = JWT::encode($payload, $secret, 'HS256', null, $header);
$data = array(
    "jwt" =>$jwt,
    "success" => "true"
);
/* we return the token to the user */
echo json_encode($data);
exit;



