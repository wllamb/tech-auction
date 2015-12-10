<?php

require_once 'dbconnect.php'; // connect to database
require_once '../user_login/index.php'; // pull user data variables from this file
$canDelete = false; // user can't delete by defaultly passing this page a value
$auctionID = $_GET['id']; // get auctons id value from URL
//$bidderName = rtrim($_SESSION['email'], '@gmail.com'); //bidder name taken from the email address with $email.com removed
$userLoggedInID = $_SESSION["user_id"]; //user who is logged in
$result = $conn->query('SELECT * FROM itemlist WHERE id = '.$auctionID)->fetch_assoc(); // find the item in the database
$actualOwnerID = $result['ownerid'];

if($userLoggedInID == $actualOwnerID)
{
  $canDelete = true;
} else {
  $canDelete = false;
}

if($canDelete == true)  {
  $sql = "DELETE FROM itemlist WHERE id='$auctionID'"; // delete the item at $auctionID from database
  $conn->query($sql); //execute statement
} else {
  echo "Error...You don't have permission to do delete this item."; //Screen output
}


?>
