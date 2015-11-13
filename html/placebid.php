<?php
    require_once '../user_login/index.php';
    require_once 'dbconnect.php';

    $auctionID = $_GET['id'];
    $bidamt = trim($_POST['bid'], '$');
    $bidderID = $_SESSION['user_id'];
    $bidderName = rtrim($_SESSION['email'], '@gmail.com');
    $result = $conn->query('SELECT * FROM itemlist WHERE id = '.$_GET['id']);
    $item = $result->fetch_assoc();
    if ($item['bidnum'] == 0) {
        $bidIncrement = 1; //this is the first bid on the item...
    } else {
        $bidIncrement = $item['bidnum'] + 1;
    }

    /******FUNCTION TO GET USERID THATS LOGGED IN******/
    // 		Code...
    //
    /*************************************************/

    if (($item['price'] < $bidamt) && ($item['hasended'] == 0)) {
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
