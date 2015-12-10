<?php
require_once 'dbconnect.php';
require_once '../user_login/index.php';
$auctionID = $_GET['id'];

$sql = "DELETE FROM itemlist WHERE id='$auctionID'";
$conn->query($sql);

?>
