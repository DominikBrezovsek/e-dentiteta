<?php

$host = "localhost";
$dbname = "ijw26577_e-checker_db";
$dbname_eid = "ijw26577_e-id";
$username_db = "ijw26577_e-id";
$password_db = "AvadaKedavra10!";


$conn =  new mysqli($host, $username_db, $password_db, $dbname);
$eid = new mysqli($host, $username_db, $password_db, $dbname_eid);

if($conn->connect_error || $eid->connect_error){
    echo ("Connection failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error);
}

?>