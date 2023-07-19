<?php
/* include database connection settings file */
include_once 'conn.php';
/* set the default timezone to UTC */
date_default_timezone_set('UTC');
/* set the time variable to the current time */
$expires = time();

/* delete all tokens that have expired */
$token = $conn->prepare("DELETE FROM token WHERE expires_at < ?");
$token-> bind_param("i", $expires);
$token->execute();

/* delete all qr code link data  that have expired */
$stmt = $conn->prepare("DELETE FROM qr_check WHERE expries_at < ?");
$stmt->bind_param("i", $expires);
$stmt->execute();
?>