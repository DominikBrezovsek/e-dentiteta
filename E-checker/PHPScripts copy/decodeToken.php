<?php
/* token.ini.php file is required because it contains variables, that are critical for decoding a token, like the token secret*/
require_once "token.ini.php";
/* checkHeader.php file is required because it contains a function that checks if the token is present in the header and saves it in the variable, that an be accessed by other files*/
require_once "checkHeader.php";
/* this libraries are used to decode tokens */
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
/* with try-catch function, we try to decode token, but if the decoding fails, catch clause logs the error */
try {
    /* the token is decoded and saved as a variable */
    $decoded_token = JWT::decode($token, new Key($secret, 'HS256'));
    /* from the associative array, that is saved as a variable above, we access and save values that can be found by field key */
    $token_id = $decoded_token->id;
    $email = $decoded_token->owner;
    /* we check if email that was written in the token matches the email, that is saved as a session variable */
        if ($email == $_SESSION['email']) {
            /* if the email matches, we check if data, used to build the token is present in the database, selecting email, because we have created an index on email colun in a database, in doing so reducing the execution time of a query */
            $stmt = $conn->prepare("SELECT email FROM token WHERE token_id= ? AND email= ?");
            $stmt->bind_param('ss', $token_id, $email);
            $stmt->execute();
            $result = $stmt->get_result();
            /* if the data is not present in the database, we return a string "Ni" */
            if ((mysqli_num_rows($result) == 0)) {
                echo json_encode("Ni");
                exit;
            }
        }
        else{
            /* if the email does not match, we return a string "Idiot ne ujema se" */
            echo json_encode("Idiot ne ujema se");
        }

} 
/* if the decoding fails, we catch the error and log it */
catch (Exception $e) {
     echo 'Caught exception: ',  $e->getMessage(), "\n";
    exit;
}


?>