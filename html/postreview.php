<?php
require_once 'dbconnect.php';

$rating = $_POST['stars'];
(string)$description = $_POST['review'];
$auctionID = $_GET['id'];

$result = $conn->query('SELECT * FROM itemlist WHERE id = '.$auctionID);
$row = $result->fetch_assoc();

$bidderid = $row['biddername'];
$bidderUID = $row['bidderid'];
$ownerid = $row['ownerid'];

$userDB = $conn->query('SELECT * FROM google_users WHERE google_id = '.$ownerid);
$ownerdata = $userDB->fetch_assoc();

$user_rating = $ownerdata['rating'] + $rating;
$max_ratings = $ownerdata['max_ratings'] + 5;

        $sql = "INSERT INTO reviews (item_id, review_text, rating, reviewer, seller, reviewid) VALUES ('$auctionID', '$description', '$rating', '$bidderid', '$ownerid','$bidderUID');";
        if ($conn->query($sql) === true) {
          //success
        }
        $sql = "UPDATE itemlist SET reviewleft='1' WHERE id=".$auctionID;
        if ($conn->query($sql) === true) {
          //success
        }
        $sql = "UPDATE google_users SET max_ratings='$max_ratings', rating='$user_rating' WHERE google_id=".$ownerid;
        if ($conn->query($sql) === true) {
          //success
        }
        header("location:account.php");



 ?>
