<?php
session_start();
require_once '../vendor/autoload.php';
require_once 'conn.php';

if (!isset($_POST['link'])) {
  echo json_encode("No link sent");
  $conn->close();
  exit;
}
$lnk = $_POST['link'];
$link_param = parse_url($lnk, PHP_URL_QUERY);
parse_str($link_param, $output);
$email = $output['uem'];
$_SESSION['register'] = $email;
exit;
?>