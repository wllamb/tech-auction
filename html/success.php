<html>

<head>
	<title>Tech Auctions</title>
	<link rel="icon" href="../images/favicon.ico" type="image/x-icon">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/default.css">
	<link rel="stylesheet" type="text/css" href="../css/list.css">
	<meta http-equiv="Refresh" content="2; URL=../html/item.php?id=<?php echo $_GET["id"];?>">
</head>
<body>

<div id="center">
	<div id="header">
		<span id="image">
			<a href="index.html">
				<img src="../images/logo_64_white.png" height="64" width="450" display: inline />
			</a>
		</span>
		<span id="menu">
			<ul>
				<li><a href="index.html">Home</a></li>
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
				<li><a href="account.html">Account</a></li>
				<li><a href="login.php">Login</a></li>
			</ul>
		</span>
		<span id="search">
			<input type="search" name="search" id = "searchIN"  value="Search: " onfocus="if(this.value == 'Search: ') {this.value=''}" onblur="if(this.value == ''){this.value ='Search: '}">
		</span>
	</div>
	<div id="space"></div>


	<div id="content">
	<h3>Your item was listed successfully! Redirecting you to the newly created item... </h3>
	</div>
	<div id="void"></div>
</div>

</body>
</html>
