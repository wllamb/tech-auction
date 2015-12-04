<?php

require_once 'dbconnect.php';
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
  <link rel="stylesheet" type="text/css" href="../css/index.css">
		<!-- jQuery library (served from Google) -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<!-- bxSlider Javascript file -->
	<script src="../js/jquery.bxslider.min.js"></script>
		<!-- bxSlider CSS file -->
	<link href="../js/jquery.bxslider.css" rel="stylesheet" />
</head>

    <!-- ALSO CHANGED; DEFAULT.CSS, INDEX.CSS -->

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
		<h3>Featured Items</h3>
	</div>
	<div class="content">
	<ul class="bxslider">
	<?php
	$sql = "SELECT * FROM itemlist WHERE hasended=0 ORDER BY RAND() LIMIT 3";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		echo '
		<li>
		<span class="flit">
			<span class="featuredImg">
				<img src="../userimages/'.$row['img'].'" height="240" width="240" class="round winning" />
				<span class="slideWin" id="s1" onclick="window.location = \'#\';">
					<h4 class="condition">Highest Bidder</h4>
					<a href="#rm"><h4 class="rm">Remove</h4></a>
				</span>
			</span>
			<span class="featured">
				<h1>'.$row['title'].'</h1>
				<p>'.$row['description'].'</p>
			</span>
		</span>
		</li>';
	}
	?>
			</ul>
			<script>
				$(document).ready(function(){
	  		$('.bxslider').bxSlider();
				});
			</script>

        <!--div id="imageStack">
            <a href="#"><img src="../images/mobo.png" height="240" width="240" class="round winning" id="left" /></a>
            <a href="#"><img src="../images/cpu.png" height="256" width="256" class="round" id="front" /></a>
            <a href="#"><img src="../images/monitor.png" height="240" width="240" class="round losing" id="right" /></a>
        </div>
		<div id="imageP">
			<p>Welcome to Tech Auctions where you can buy and sell computer-related techology. Please take a moment to sign in or create an account to buy and sell, or feel free to search around as a guest.</p>
		</div-->


        <!--a href="#" onclick="document.getElementById('flit1').style.marginLeft='-1000';"><</a>

        <a href="#" onclick="document.getElementById('flit1').style.marginLeft='0';">></a>
        <div class="flit" id="flit1">
            <div class="featuredImg">
				<img src="../images/cpu.png" height="240" width="240" class="round" />
			</div>
			<span class="featured">
				<h1>Yolo Swagger bums</h1>
				<p>This item is dope af.  I like it.  If I didn't already have a better processor, I might have been tempted to pick one of these up.  But I have a better processor because I'm a boss.  Yummy!</p>
			</span>
        </div>

        <div class="flit" id="flit2" style="background-color:red;">
            <div class="featuredImg">
				<img src="../images/cpu.png" height="240" width="240" class="round" />
			</div>
			<span class="featured">
				<h1>Yolo Swagger bums</h1>
				<p>This item is dope af.  I like it.  If I didn't already have a better processor, I might have been tempted to pick one of these up.  But I have a better processor because I'm a boss.  Yummy!</p>
			</span>
        </div-->

		<!--
		<span class="navL">
			<a width="50" height="50"></a>
		</span>
		<span class="flit">
            <span class="featuredImg">
				<img src="../images/cpu.png" height="240" width="240" class="round winning" />
				<span class="slideWin" id="s1" onclick="window.location = '#';">
					<h4 class="condition">Highest Bidder</h4>
					<a href="#rm"><h4 class="rm">Remove</h4></a>
				</span>
			</span>
			<span class="featured">
				<h1>Yolo Swagger bums</h1>
				<p>This item is dope af.  I like it.  If I didn't already have a better processor, I might have been tempted to pick one of these up.  But I have a better processor because I'm a boss.  Yummy!</p>
			</span>
        </span>
		<span class="navR">
			<a width="50" height="50"></a>
		</span> -->

		<div id="void"></div>
	</div>


</div>
</body>
</html>
