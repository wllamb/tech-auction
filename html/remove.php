<?php

require_once 'dbconnect.php'; // connect to database
require_once '../user_login/index.php'; // pull user data variables from this file
$canDelete = false; // user can't delete by defaultly passing this page a value
$auctionID = $_GET['id']; // get auctons id value from URL
//$bidderName = rtrim($_SESSION['email'], '@gmail.com'); //bidder name taken from the email address with $email.com removed
$userLoggedInID = $_SESSION["user_id"]; //user who is logged in
$result = $conn->query('SELECT * FROM itemlist WHERE id = '.$auctionID)->fetch_assoc(); // find the item in the database
$actualOwnerID = $result['ownerid'];

if ($_SESSION['logged_in'] == true) {
		$logoutText = 'Logout';
		$dynamicURL = LOGOUT_URL;
		$userid = $_SESSION['user_id'];
} else {
		$dynamicURL = 'login.php';
		$logoutText = 'Login';
}

if($userLoggedInID == $actualOwnerID)
{
  $canDelete = true;
} else {
  $canDelete = false;
}

if($canDelete == true)  {
  $sql = "DELETE FROM itemlist WHERE id='$auctionID'"; // delete the item at $auctionID from database
  $conn->query($sql); //execute statement
    $title = "Success!";
    $text = "Your item was successfully removed";
} else {
    $title = "Error!";
    $text = "You don't have permission to do delete this item.";
}

?>


<html>

<head>
	<title>Tech Auctions</title>
	<link rel="icon" href="../images/favicon.ico" type="image/x-icon">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/default.css">
	<meta http-equiv="Refresh" content="2; URL=account.php">
</head>
<body>

    <div id="center">
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
						<li><a href="shop.php">Shop</a>
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
        <h3><?php echo $title ?></h3>
    </div>
	<div class="content" style="text-align: center;">
	<p><?php echo $text ?></p>
    <input type="button" value="Ok" onclick="window.location.href = 'account.php'"/>
	</div>
	<div id="void"></div>
</div>

</body>
</html>
