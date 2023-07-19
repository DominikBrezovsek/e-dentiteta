<?php

session_start();

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: *");

if (isset($_FILES['img'])) {
  $image = $_FILES['img'];

  // Check if file was uploaded successfully

    move_uploaded_file($image['tmp_name'], __DIR__ . '/../images/' . $image['name']);

    // Store file and form data in database or perform other actions
    // ...
    $_SESSION['image'] = "https://e-dentiteta.zanurban.si/images/".$image['name'];
    
    

    echo json_encode('File uploaded successfully');
    exit;
}





?>