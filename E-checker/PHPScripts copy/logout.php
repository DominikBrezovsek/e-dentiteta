<?php
session_start();
/* include all of the necessary files for headers and token decoding */
require_once 'header.php';
include_once 'conn.php';
require_once '../vendor/autoload.php';
require_once "decodeToken.php";
require_once "checkHeader.php";
/* if the logout variable is set to true and the token is present in the header, we delete the token from the database and destroy the session */
if ($_POST['logout'] == "true" && $authorization != "") {    
    $token_exp = $decoded_token->exp;
    $jti = $decoded_token->id;
    $stmt = $conn->prepare("DELETE FROM token WHERE token_id= ?");
    $stmt->bind_param('s', $jti);
    $stmt->execute();
    unset($_SESSION['email']);
    session_destroy();
    exit;
}
else{
}

?>