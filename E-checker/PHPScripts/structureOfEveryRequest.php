<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: *");

session_start();
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require_once '../vendor/autoload.php';

$headers = getallheaders();
$authorization = isset($headers['Authorization']) ? $headers['Authorization'] : '';
$token = str_replace('Bearer ', '', $authorization);
date_default_timezone_set('UTC');

$host = "localhost";
$dbname = "zanurban_e-ck";
$username_db = "zanurban_developer";
$password_db = "JustMeXD69";

$conn = new mysqli($host, $username_db, $password_db, $dbname);

if (isset($_SESSION['superuser']) && $authorization != '') {

$jwt_secret = "WingardiumLeviosa10";
try {
    $decoded_token = JWT::decode($token, new Key($jwt_secret, 'HS256'));
    $token_id = $decoded_token->token_id;
    $jti = $decoded_token->jti;
        if ($token_id == $_SESSION['superuser']) {
            $stmt = $conn->prepare("SELECT * FROM JWTtoken WHERE token_id= ? AND jti= ?");
            $stmt->bind_param('ss', $token_id, $jti);
            $stmt->execute();
            $result = $stmt->get_result();
            if (!(mysqli_num_rows($result) > 0)) {
                echo json_encode("Ni");
                exit;
            }
        }
        else{
            echo json_encode("Idiot ne ujema se");
        }

} catch (Exception $e) {
     echo 'Caught exception: ',  $e->getMessage(), "\n";
    exit;
}

}

?>