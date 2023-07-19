<?php
session_start();
require_once '../vendor/autoload.php';
require_once 'conn.php';


$email = $_SESSION['register'];
$stmt = $conn->prepare("SELECT email FROM pending_accounts WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
  echo json_encode("Invalid link.");
  $conn->close();
  exit;
}
if (!isset($_POST['password'])) {
    echo json_encode("No password sent.");
    $conn->close();
    exit;
  }
  if (!isset($_POST['username'])) {
    echo json_encode("No username sent.");
    $conn->close();
    exit;
  }
$password = $_POST['password'];
$username = $_POST['username'];
$user_create = $conn->prepare("SELECT name, surname FROM pending_accounts WHERE email = ?");
$user_create->bind_param("s", $email);
$user_create->execute();
$result = $user_create->get_result();
$row = $result->fetch_assoc();
$name = $row['name'];
$surname = $row['surname'];
$user_create->close();

$stmt = $conn->prepare("INSERT INTO user (email, name, surname) VALUES (?,?,?)");
$stmt->bind_param("sss", $email, $name, $surname);
$stmt->execute();
$stmt->close();


$stmt = $conn->prepare("INSERT INTO login (email, username, password) VALUES (?,?,?)");
$stmt->bind_param("sss", $email, $username, $password);
$stmt->execute();

$stmt = $conn->prepare("DELETE FROM pending_accounts WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

echo json_encode("true");
$conn->close();
$_SESSION['register'] = null;
exit;

?>
