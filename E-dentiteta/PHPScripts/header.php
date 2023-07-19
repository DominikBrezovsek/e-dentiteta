<?php
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: *");

//Sets time to UTC, to avoid token complications
date_default_timezone_set('UTC');
?>