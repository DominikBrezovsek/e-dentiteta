<?php 
session_start();

require_once 'header.php';
include_once 'conn.php';
require_once '../vendor/autoload.php';
require_once 'token.ini.php';

/* check if the session variable for SQL queries is set */

if(isset($_SESSION['email'])){
/*if it is set, save it as a variable */
    $email = $_SESSION['email'];
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        exit;
    }
    //select all cards that belong to the user that is currently logged in
    $cards = $conn->prepare("SELECT * FROM card WHERE owner = ?");
    $cards-> bind_param('s', $email);
    $cards->execute();
    $result = $cards->get_result();
    
    $card_array = array(); // Create an empty array to hold the card objects
    
    if(mysqli_num_rows($result) > 0){
        while($data = $result->fetch_assoc()){
            // using while loop, append the data from the database to the card object
            $card = new stdClass();
            $card->naslov = $data['type'];
            $card->pot = "https://e-dentiteta.zanurban.si/images/" .$data['image'];
            $card_array[] = $card; // Add the card object to the array
        }
        // Create a response object and encode it to JSON
        $response = new stdClass();
        $response->object = $card_array;
        $json = json_encode($response);
        echo $json;
        exit;
    } else {
        // if there is no cards assigned to the user, return a string "No cards"
        echo json_encode("No cards");
        exit;
    }
}
else {
    // if the session variable is not set, return a string "No session"
        echo json_encode("No session");
        exit;
    }    
?>