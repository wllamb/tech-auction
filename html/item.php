<?php
	require_once('dbconnect.php');
	require_once ('../user_login/index.php');
	require_once ('cronjob.php');

		// unset if after it display the error.
		$_SESSION["e_msg"] = "";

		if ($_SESSION["logged_in"] == true) {
		  $logoutText = "Logout";
		  $dynamicURL = LOGOUT_URL;
		} else {
			$dynamicURL = "login.php";
			$logoutText = "Login";
		}

	$result = $conn->query('SELECT * FROM itemlist WHERE id = '.$_GET["id"]);
	$item = $result->fetch_assoc();

	date_default_timezone_set("America/New_York");
	$startDate = strtotime("".$item["dateposted"]."");
	$endDate = strtotime("+".$item["length"]." days","$startDate");
	$year = date("Y",$endDate);
	$month = (int)date("m",$endDate);
	$day = date("d",$endDate);
	$hour = date("h",$endDate);
	$minute = date("i",$endDate);
	$AMPM = date("a",$endDate);

?>
<head>
	<title>Tech Auctions</title>
	<link rel="icon" href="../images/favicon.ico" type="image/x-icon">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/default.css">
	<link rel="stylesheet" type="text/css" href="../css/item.css">
</head>
<body>

<div id="center" style="height: 100%;">
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
		<h3>Time Left:</h3>
		<h3 id="cntdwn">
		<script language="JavaScript">
		TargetDate = "'<?php echo $month; ?>'/'<?php echo $day; ?>'/'<?php echo $year; ?>' <?php echo $hour.':'.$minute.' '.$AMPM?>";
		CountActive = true;
		CountStepper = -1;
		LeadingZero = false;
		DisplayFormat = "%%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds";
		FinishMessage = "The auction has ended.";
		</script>
		<script language="JavaScript" src="./countdown.js"></script>
		</h3>
	</div>
	<div id="content">
<?php
			if($_SESSION["logged_in"] == true)
			{
				$loginButton = '<input type="submit" value="Place Bid" />';
			} else {
				$loginButton = '';
			}
			$result = $conn->query('SELECT * FROM itemlist WHERE id = '.$_GET["id"]);
			$item = $result->fetch_assoc();
			echo '
			<h1 style="text-align:left">'.$item["title"].'</h1>
			<h4><a href src="#">Seller: '.$item["ownername"].'</a></h4>
			<br>
			<div id="listingImg">
				<img src="../userimages/'.$item["img"].'" height="256" width="256" class="round" />
			</div>
			<span id="listing">
				<form id="bidPlace" action="placebid.php?id='.$_GET["id"].'" method="post">
					<input type="text" name="bid" value="$'.$item["price"].'" />
					'.$loginButton.'
				</form>
				<p>'.$item["description"].'</p>
			</span>

			';//end php echo
			?>
		<div id="void"></div>
	</div>

</div>

</body>
</html>