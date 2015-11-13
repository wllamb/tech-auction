<?php

require_once 'dbconnect.php';
require_once '../user_login/index.php';

// unset if after it display the error.
$_SESSION['e_msg'] = '';

        if ($_SESSION['logged_in'] == true) {
            $logoutText = 'Logout';
            $dynamicURL = LOGOUT_URL;
            $userid = $_SESSION['user_id'];
        } else {
            header('location: ./login.php');
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
	<link rel="stylesheet" type="text/css" href="../css/list.css">
	<link rel="stylesheet" type="text/css" href="../css/account.css">
</head>
<body>

<div id="center">
	<div id="header">
		<span id="image">
			<a href="index.php">
				<img src="../images/logo_64_white.png" height="64" width="450" display: inline />
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
		<span id="search">
			<input type="search" name="search" id = "searchIN"  value="Search: " onfocus="if(this.value == 'Search: ') {this.value=''}" onblur="if(this.value == ''){this.value ='Search: '}">
		</span>
	</div>
	<div id="space"></div>

	<div id="title">
		<h3>Account Summary</h3>
	</div>
	<div id="content">
  <?php if ($_SESSION['new_user'] == 'yes') {
    ?>
    <h3 style="text-align:center">Thank you <?php echo $_SESSION['name'] ?>, for registering with us!</h3><br>
	<div id="listingImg">
	<img class="img-circle" src="<?php echo $_SESSION['picture']?>" height="200" width="200"></img>
	</div>
	<span id="listing">
	<h3 style="text-align:left">Your display name is: <?php echo rtrim($_SESSION['email'], '@gmail.com');
    ?></h3>
	<h3 style="text-align:left">The email address on file is: <?php echo $_SESSION['email'];
    ?></h3>
  <?php
} else {
    ?>
	<div id="listingImg">
	<img class="img-circle" src="<?php echo $_SESSION['picture']?>" height="200" width="200"></img>
	</div>
	<span id="listing">
	<h3 style="text-align:left">Your display name is: <?php echo rtrim($_SESSION['email'], '@gmail.com');
    ?></h3>
	<h3 style="text-align:left">The email address on file is: <?php echo $_SESSION['email'];
    ?></h3>
	<?php
} ?>
	</span>
	<div id="void"></div>
	</div>

	<div id="title">
		<h3>Item's your bidding on</h3>
	</div>
		<div id="content">
	<?php
            $result = $conn->query('SELECT * FROM bids WHERE bidderid = '.$userid.'');
            if ($result->num_rows > 0) {
                // output data of each row
                $itemPosition = 0;
                while ($row = $result->fetch_assoc()) {
                    if ($row['auctionid'] == $itemPosition) {
                        //we do nothing
                    } else {
                        $itemPosition = $row['auctionid'];
                        $resultTwo = $conn->query('SELECT * FROM itemlist WHERE id = '.$row['auctionid'].'');
                        if ($resultTwo->num_rows > 0) {
                            while ($rowTwo = $resultTwo->fetch_assoc()) {
                                echo '
							<div id="listingImg">
							<a href="item.php?id='.$rowTwo['id'].'"><img src="../userimages/'.$rowTwo['img'].'" height="128" width="128" class="round" /></a>
							</div>
							<span id="listing">
								<a href="item.php?id='.$rowTwo['id'].'" id="titleAuction">'.$rowTwo['title'].'</a>
								<a href="item.php?id='.$rowTwo['id'].'" id="price">$'.$rowTwo['price'].'</a>
								<h4><a href="#">Seller: '.$rowTwo['ownername'].'</a></h4>
								<a href="item.php?id='.$rowTwo['id'].'"><p>'.$rowTwo['description'].'</p></a>
							</span>
							<div id="void"></div>
							<hr />';
                            }
                        } else {
                            echo '<center>Sorry no items were found in your search!</center>';
                        }
                    }
                }
            } else {
                echo '<center>Sorry no items were found in your search!</center>';
            }

    ?>
		<div id="void"></div>
		</div>
			<div id="title">
		<h3>Item's your selling</h3>
	</div>
		<div id="content">
	<?php
            $resultThree = $conn->query('SELECT * FROM itemlist WHERE ownerid = '.$userid.'');
            if ($resultThree->num_rows > 0) {
                // output data of each row
            while ($row = $resultThree->fetch_assoc()) {
                echo '
					<div id="listingImg">
					<a href="item.php?id='.$row['id'].'"><img src="../userimages/'.$row['img'].'" height="128" width="128" class="round" /></a>
					</div>
					<span id="listing">
						<a href="item.php?id='.$row['id'].'" id="titleAuction">'.$row['title'].'</a>
						<a href="item.php?id='.$row['id'].'" id="price">$'.$row['price'].'</a>
						<h4><a href="#">Seller: '.$row['ownername'].'</a></h4>
						<a href="item.php?id='.$row['id'].'"><p>'.$row['description'].'</p></a>
					</span>
					<div id="void"></div>
					<hr />
				';
            }
            } else {
                echo "<center>Sorry you currently aren't selling any items.</center>";
            }

    ?>
		<div id="void"></div>
		</div>


</body>
</html>
