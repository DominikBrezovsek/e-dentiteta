<?php

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: *");
//$request_data = json_decode(file_get_contents('php://input'), true);

$requestBody = file_get_contents('php://input');
$requestData = json_decode($requestBody);

if(!isset($_POST['lid'])){
    $response = array(
        "success" => "false"
        );
    echo json_encode($response);
}
$lid = $_POST['lid'];

$host = "localhost";
    $dbname = "zanurban_e-id";
    $username_db = "zanurban_developer";
    $password_db = "JustMeXD69";
    
    $conn = new mysqli($host, $username_db, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        exit;
    }
    $stsm = $conn->prepare("SELECT token_id FROM validation WHERE valid_id = ?");
    $stsm->bind_param("s", $lid);
    $stsm->execute();
    $result = $stsm->get_result();
    
    if($result->num_rows == 1){
        $response = array(
            "success" => "true"
            );
        echo json_encode($response);
    }
    else{
        $response = array(
            "success" => "false"
            );
        echo json_encode($response);
    }
    
    
?>