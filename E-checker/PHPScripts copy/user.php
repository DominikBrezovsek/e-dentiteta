<?php
session_start();
/* include all of the necessary files for database connection */
include_once 'conn.php';
/* check if the email variable is set */
if (!isset($_SESSION['email'])) {
    echo "False";
    exit;
}


// check database connection 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    exit;
}
$email = $_SESSION['email'];
/* using structured SQL query, we select all the necesary data from  two tables in the database, using inner join to achieve this*/
$user = $conn->prepare("SELECT name, surname, user.email, username FROM user INNER JOIN login ON user.email = login.email WHERE user.email = ?");
$user->bind_param('s', $email);
$user->execute();
$result = $user->get_result();

$user_array = array(); // Create an empty array to hold the card objects
// if the query returns any data, we create an object and add it to the array
if (mysqli_num_rows($result) > 0) {
    while ($data = $result->fetch_assoc()) {
        $user_data = new stdClass();
        $user_data->name = $data['name'];
        $user_data->surname = $data['surname'];
        $user_data->email = $data['email'];
        $user_data->username = $data['username'];
        $user_array[] = $user_data; // Add the card object to the array
    }
    // we encode the array into json and return it to the user
    $json = json_encode($user_array);
    echo $json;
    exit;
} else {
    echo "False";
    exit;
}

?>