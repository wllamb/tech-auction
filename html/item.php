<head>
	<title>Tech Auctions</title>
	<link rel="icon" href="../images/favicon.ico" type="image/x-icon">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/default.css">
	<link rel="stylesheet" type="text/css" href="../css/item.css">
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
					<li><a href="../user_login/logout.php">Logout</a></li>
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
		<h3>Time Left: time is here</h3>
	</div>
	<div class="content">
			<h1>This is an item</h1>
			<br>
			<div id="listingImg">
				<img src="../images/black.png" height="256" width="256" class="round winning" id="jsBitches"/>
				<span class="slideWin" id="s1" onclick="window.location = '#';">
					<h4 class="condition">Winning</h4>
					<a href="#rm"><h4 class="rm">Remove</h4></a>
				</span>
				<img src="../images/black.png" height="60" width="60" class="round mini" onclick="document.getElementById('jsBitches').src = '../images/black.png';" style="margin-left:2;"/>
				<img src="../images/cpu.png" height="60" width="60" class="round mini" onclick="document.getElementById('jsBitches').src = '../images/cpu.png';" />
				<img src="../images/mobo.png" height="60" width="60" class="round mini" onclick="document.getElementById('jsBitches').src = '../images/mobo.png';" />
				<img src="../images/monitor.png" height="60" width="60" class="round mini" onclick="document.getElementById('jsBitches').src = '../images/monitor.png';" />
			</div>
			<span id="listing">
				<h4><a href src="#">Seller: herpaderp</a></h4>
				<form id="bidPlace" action="placebid.php?id='.$_GET['id'].'" method="post">
					<input type="text" name="bid" value="$'.$item['price'].'" />
					Bid
				</form>
				<p>Lorem ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</p>
			</span>
		<div id="void"></div>
	</div>

</div>

</body>
</html>
