<?php

require_once 'dbconnect.php';
require_once '../user_login/index.php';

// unset if after it display the error.
$_SESSION['e_msg'] = '';

            if ($_SESSION['logged_in'] == true) {
                $logoutText = 'Logout';
                $dynamicURL = LOGOUT_URL;
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
</head>
<body>

<div id="center" style="height: 100%;">
	<div id="header">
		<span id="image">
			<a href="#">
				<img src="../images/logo_64_white.png" height="64" width="450" display: inline />
			</a>
		</span>
		<span id="menu">
			<ul>
				<li><a href="#">Home</a></li>
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
		<h3>Featured Items</h3>
	</div>
	<div id="content">
		<div id="imageStack">
			<a href="item.html"><img src="../images/mobo.png" height="240" width="240" class="round" id="one" /></a>
			<a href="item.html"><img src="../images/cpu.png" height="256" width="256" class="round" id="two" /></a>
			<a href="item.html"><img src="../images/monitor.png" height="240" width="240" class="round" id="three" /></a>
		</div>
		<div id="imageP">
			<p>Welcome to Tech Auctions where you can buy and sell computer-related techology. Please take a moment to sign in or create an account to buy and sell, or feel free to search around as a guest.</p>
		</div>
		<div id="void"></div>
	</div>
	<center><a href="http://www.freedomain.co.nr/" target="_blank" title="Free Domain Name" rel="nofollow"><img src="http://cmrsa.imdrv.net/328/9.gif" width="88" height="31" border="0" alt="Free Domain Name" /></a></center>

</div>
</body>
</html>
