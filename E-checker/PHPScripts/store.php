<?php

session_start();

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: *");

if (isset($_FILES['img'])) {
  $image = $_FILES['img'];


    move_uploaded_file($image['tmp_name'], __DIR__ . '/../../../e-dentiteta.zanurban.si/images/' . $image['name']);

    $_SESSION['image'] = "https://e-dentiteta.zanurban.si/images/".$image['name'];
    
    

    echo json_encode('File uploaded successfully');
    exit;
}





?>