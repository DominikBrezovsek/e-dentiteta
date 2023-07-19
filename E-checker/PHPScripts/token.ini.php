<?php

/* set timzone to universal coorditated time */
date_default_timezone_set('UTC');
/* check if session variable email is set to avoid errors */
if (isset($_SESSION['email'])){
  $email = $_SESSION['email'];
  }
$token_id = uniqid("TID");
$owner = hash('sha256', $email);
$issued_at = time();
$not_before = $issued_at;
$expire = $issued_at + (5*60);
$issuer = "https://e-checker.usdd.company";
$audience = "https://e-checker.usdd.company";
$secret = "Sectumsempra420?";

$header = array(
    "typ" => "JWT",
    "alg" => "HS256",
    "kid" => $token_id
  );
$payload = array(
  "iss" => $issuer,
  "aud" => $audience,
  "iat" => $issued_at,
  "nbf" => $not_before,
  "exp" => $expire,
  "id" => $token_id,
  "owner" => $email,
);
?>