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
	<meta http-equiv="Refresh" content="2; URL=../html/item.php?id=<?php echo $_GET["id"];?>">
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
        <h3>Success!</h3>
    </div>
	<div class="content" style="text-align: center;">
	<p>Your item was posted succesfully!</p>
    <input type="button" value="Ok" onclick="window.location.href = 'item.php?id=<?php echo $_GET["id"];?>'"/>
	</div>
	<div id="void"></div>
</div>

</body>
</html>
