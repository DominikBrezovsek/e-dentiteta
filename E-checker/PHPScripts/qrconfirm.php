<?php
session_start();
require_once '../vendor/autoload.php';
include_once 'conn.php';
require_once 'header.php';

$tid = $_GET['id'];
$lid = $_GET['lid'];


$user_verify = $eid->prepare("SELECT token_id FROM qr_check WHERE token_id = ? AND link_id= ?");
$user_verify->bind_param("ss",$tid, $lid);
$user_verify->execute();
$result = $user_verify->get_result();

if (mysqli_num_rows($result) == 0) {
    echo "No verification found";
    $conn -> close();
    header("Location: https://e-checker.usdd.company/validation/ok");
    exit;
}
header("Location: https://e-checker.company.company/verification/denied");
exit;



?>