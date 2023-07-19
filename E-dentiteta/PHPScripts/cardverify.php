<?php
/* include database connection settings file */
session_start();
require_once '../vendor/autoload.php';
include_once 'conn.php';

/* check if email variable is set and if authorisation is present*/
if (!isset($_SESSION['email']) && $authorization == '') {
    echo json_encode("false");
    exit;
}

/* check if the card type has been sent via post request */
if (!isset($_POST['tip']) || !isset($_POST['id'])) {
    echo json_encode("Nisi poslal tipa!");
    exit;
}
/* if the email variable is set and card type has been sent,  we decode the token*/
require_once 'decodeToken.php';
$tip = $_POST['tip'];
$card_id = $_POST[' '];
/* we create a expiration time and set it to one minute after now */
$exp = time() + 1 * 60;
/* we create a unique id for the link */
$valid_id = uniqid();
/* we store the current time into variable */
$iss = time();
/* we crate the link with the variables above as arguments */
$link = "https://e-checker.usdd.company/APIs/qrconfirm.php?id=$token_id&card=$tip&lid=$valid_id&cid=$card_id";
/* we insert the data that was used to create the link,  into the database */
$stmt = $conn->prepare("INSERT INTO qr_check(link_id, card_id, token_id, issued_at, expries_at) VALUES (?,?,?,?,?)");
$stmt->bind_param('sssss',$valid_id, $card_id, $token_id,$iss, $exp);
$stmt->execute();
/* we return the link to the user */
echo json_encode($link);
exit;
?>