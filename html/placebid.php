<?php
    require_once '../user_login/index.php';
    require_once 'dbconnect.php';
    $canPlaceBid = true;
    $auctionID = $_GET['id']; // get the auctions id value from database
    $bidamt = trim($_POST['bid'], '$'); // bid amount placed by the user
    $bidderID = $_SESSION['user_id']; //current bidders user id pulled from session data
    $bidderName = rtrim($_SESSION['email'], '@gmail.com'); //bidder name taken from the email address with $email.com removed
    $result = $conn->query('SELECT * FROM itemlist WHERE id = '.$_GET['id']); // find the item in the database
    $item = $result->fetch_assoc();
    $ownerID = $_SESSION["user_id"];
    //lets handle the case of user bidding on an item he/she listed
    if($bidderID == $ownerID)
    {
      $canBid = false; //user cant bid
    } else {
      $canBid = true; // user can bid
    }
    if ($item['bidnum'] == 0) {
        $bidIncrement = 1; //this is the first bid on the item...
    } else {
        $bidIncrement = $item['bidnum'] + 1; //these are subsequent bids
    }



    if (($item['price'] < $bidamt) && ($item['hasended'] == 0) && ($_SESSION['logged_in'] == true) && ($canBid == true)) {
        $sql = "UPDATE itemlist SET price='".$bidamt."', bidderid='".$bidderID."', bidnum='".$bidIncrement."', biddername='".$bidderName."' WHERE id=".$auctionID;
        if ($conn->query($sql) === true) {
            echo 'Record updated successfully';
            echo '
				<SCRIPT language="JavaScript">
				<!--
				window.location="../html/item.php?id='.$auctionID.'";
				//-->
				</SCRIPT>
				';//end html echo
        } else {
            echo 'Error updating record: '.$conn->error;
        }

        $insert = "INSERT INTO bids (auctionid, bidamt, bidnum, bidderid)
							VALUES ('$auctionID', '$bidamt', '$bidIncrement', '$bidderID');";
        if ($conn->query($insert) === true) {
            $last_id = $conn->insert_id; // gets the items id#
        } else {
            echo 'Error: '.$sql.'<br>'.$conn->error;
        }
    } else {
        if ($item['hasended'] == 1) {
            echo 'The auction is over..';
        } else {
            echo "Error...bid wasn't high enough";
        }
    }
