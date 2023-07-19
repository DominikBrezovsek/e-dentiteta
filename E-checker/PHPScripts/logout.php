<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: *");

session_start();
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once '../vendor/autoload.php';

$host = "localhost";
$dbname = "zanurban_e-ck";
$username_db = "zanurban_developer";
$password_db = "JustMeXD69";


$con = new mysqli($host, $username_db, $password_db, $dbname);




$headers = getallheaders();
$authorization = isset($headers['Authorization']) ? $headers['Authorization'] : '';
date_default_timezone_set('UTC');
// Check if the user has closed the tab
if ($_POST['logout'] == "true" && $authorization != '') {
    $token = str_replace('Bearer ', '', $authorization);
    $jwt_secret = "WingardiumLeviosa10";
    $decoded_token = JWT::decode($token, new Key($jwt_secret, 'HS256'));
    $token_exp = $decoded_token->token_exp;
    $jti = $decoded_token->jti;
    $stmt = $con->prepare("DELETE FROM JWTtoken WHERE jti= ?");
    $stmt->bind_param('s', $jti);
    $stmt->execute();
    unset($_SESSION['superuser']);
    session_destroy();
}

?>