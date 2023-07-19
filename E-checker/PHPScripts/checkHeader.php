<?php
$headers = getallheaders();
$authorization = isset($headers['Authorization']) ? $headers['Authorization'] : '';
if($authorization != ''){
    $token = str_replace('Bearer ', '', $authorization);
}
else {
    $token = null;
    echo("Token");
}
?>