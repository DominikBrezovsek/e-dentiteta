<?php 
session_start();

require_once 'header.php';
require_once 'checkHeader.php';
include_once 'conn.php';
if(!isset($_SESSION['email'])){
    echo "False";
    
}

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$email = $_SESSION['email'];
$type = $_POST['type'];
    
    $cards = $conn->prepare("SELECT date_of_expiration, type, image, name, surname  FROM card INNER JOIN user on card.owner = user.email WHERE owner = ? and type = ?");
    $cards-> bind_param('ss', $email, $type);
    $cards->execute();
    $result = $cards->get_result();
    
    $card_array = array();
    
    if(mysqli_num_rows($result) > 0){
        while($data = $result->fetch_assoc()){
        
            $card = new stdClass();                
            $card -> name = $data['name'];
            $card -> surname = $data["surname"];
            $card -> DOE = $data["date_of_expiration"];
            $card -> type = $data["type"];
            $card -> image =  "https://e-dentiteta.zanurban.si/images/" .$data["image"];
            $card_array[] = $card;

        }

        $json = json_encode($card_array);
        echo $json;
        exit;
    }
    else{
        echo "False";
        exit;
    }






?>