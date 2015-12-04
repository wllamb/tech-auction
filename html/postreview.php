<?php
require_once 'dbconnect.php';

$rating = $_POST['stars'];
$description = $_POST['review'];
$auctionID = $_GET['id'];

$result = $conn->query('SELECT * FROM itemlist WHERE id = '.$auctionID);
$row = $result->fetch_assoc();

$sql = "INSERT INTO reviews (item_id, review_text, rating, reviewer, seller)
VALUES ('$row['id']', '$row['title']', '$rating', '$startPrice');";

        if ($conn->query($sql) === true) {
            $last_id = $conn->insert_id; // gets the items id#
        }

$sql = "UPDATE itemlist SET price='".$bidamt."', bidderid='".$bidderID."', bidnum='".$bidIncrement."', biddername='".$bidderName."' WHERE id=".$auctionID;
  if ($conn->query($sql) === true) {
      echo 'Record updated successfully';
 ?>
