<?php

require_once '../vendor/autoload.php';
include_once 'conn.php';

for($i = 0; $i < 1000; $i++){
    $faker = Faker\Factory::create('sl_SI');
    $username = $faker -> userName();
    $password = $faker -> password();
    $name = $faker -> firstName();
    $surname = $faker -> lastName();
    $email = $faker -> email();

$stmt = $conn->prepare("INSERT INTO user VALUES(?,?,?,?,?)");
$stmt->bind_param("sssss", $username, $password, $name, $surname, $email);
$stmt-> execute();
}


?>