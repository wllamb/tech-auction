<?php
    require_once '../user_login/index.php';
    require_once 'dbconnect.php';
    $canBid = true;
    $auctionID = $_GET['id']; // get the auctions id value from database
    $bidamt = trim($_POST['bid'], '$'); // bid amount placed by the user
    $bidderID = $_SESSION['user_id']; //current bidders user id pulled from session data
    $bidderName = rtrim($_SESSION['email'], '@gmail.com'); //bidder name taken from the email address with $email.com removed
    $result = $conn->query('SELECT * FROM itemlist WHERE id = '.$_GET['id']); // find the item in the database
    $item = $result->fetch_assoc();
    $ownerID = $item["ownerid"];
    //lets handle the case of user bidding on an item he/she listed
    if($bidderID == $ownerID)
    {
      $canBid = false; //user cant bid
    } else if($bidderID != $ownerID) {
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
            $title = "Success!";
            $message = "Bid posted succesfully!";
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
            $title = "Error!";
            $message = 'The auction has ended';
        } else if($canBid == false) {
            $title = "Error!";
            $message = 'You cannot bid on your own item.';
        }
    }
?>


<?php
require_once '../user_login/index.php';

if ($_SESSION['logged_in'] == true) {
		$logoutText = 'Logout';
		$dynamicURL = LOGOUT_URL;
		$userid = $_SESSION['user_id'];
} else {
		$dynamicURL = 'login.php';
		$logoutText = 'Login';
}
?>

<html>
<head>
	<title>Tech Auctions</title>
	<link rel="icon" href="../images/favicon.ico" type="image/x-icon">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/default.css">
  <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>

    <!-- ALSO CHANGED; DEFAULT.CSS, INDEX.CSS -->

<body>

<div id="center" style="height:100%;">
	<div id="header">
		<div id="headCenter">
			<span id="image">
				<a href="index.php">
					<img src="../images/logo.svg" width="64" display: inline />
				</a>
			</span>
			<span id="menu">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="#">Shop</a>
						<ul>
							<li><a href="list.php?cat=0">CPUs</a></li>
							<li><a href="list.php?cat=1">Cooling</a></li>
							<li><a href="list.php?cat=2">Motherboards</a></li>
							<li><a href="list.php?cat=3">RAM</a></li>
							<li><a href="list.php?cat=4">GPUs</a></li>
							<li><a href="list.php?cat=5">PSUs</a></li>
							<li><a href="list.php?cat=6">Cases</a></li>
							<li><a href="list.php?cat=7">HDDs</a></li>
							<li><a href="list.php?cat=8">SSds</a></li>
							<li><a href="list.php?cat=9">Monitors</a></li>
							<li><a href="list.php?cat=10">Keyboards</a></li>
							<li><a href="list.php?cat=11">Mice</a></li>
						</ul>
					</li>
					<li><a href="sell.php">Sell</a></li>
					<li><a href="account.php">Account</a></li>
					<li><a href="<?php echo $dynamicURL; ?>"><?php echo $logoutText;?></a></li>
				</ul>
			</span>
		</div>
    <span id="search">
      <form  method="post" action="search.php?go"  id="searchform">
			     <input type="search" name="name" id = "searchIN"  value="Search: " onfocus="if(this.value == 'Search: ') {this.value=''}" onblur="if(this.value == ''){this.value ='Search: '}">
      </form>
    </span>
	</div>
	<div id="space"></div>

	<div class="title">
		<h3><?php echo $title; ?></h3>
	</div>
	<div class="content">
		<p><?php echo $message; ?></p>
        <input type="button" value="Ok" onclick="window.history.back()"/>
	</div>

</div>

</body>
</html>
