<html>
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
	$auctionID = $_GET['id'];
	$result = $conn->query('SELECT * FROM itemlist WHERE id = '.$auctionID);
	$row = $result->fetch_assoc();
	$itemTitle = $row['title']
	//add in security
	//logged in user must be winner, hasended = 1
?>
<head>
	<title>Tech Auctions</title>
	<link rel="icon" href="../images/favicon.ico" type="image/x-icon">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/default.css">
    <link rel="stylesheet" type="text/css" href="../css/review.css">
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
		<h3><?php echo $itemTitle;?></h3>
	</div>
	<form class ="content" action="postreview.php?id=<?php echo $row['id'];?>" method="post" enctype="multipart/form-data">
		<div class="item">
			<div class="left">
				<label for="rating">
					Rating:
				</label>
			</div>
			<div class="right"><!-- &#9733, &#9734 -->
				<span id="rating">
					<input type="radio" name="stars" value="1" id="radio1" onclick="starSetter(1)" required/>
					<label for="radio1"><span id="one"></span></label>
					<input type="radio" name="stars" value="2" id="radio2" onclick="starSetter(2)" required/>
					<label for="radio2"><span id="two"></span></label>
					<input type="radio" name="stars" value="3" id="radio3" onclick="starSetter(3)" required/>
					<label for="radio3"><span id="three"></span></label>
					<input type="radio" name="stars" value="4" id="radio4" onclick="starSetter(4)" required/>
					<label for="radio4"><span id="four"></span></label>
					<input type="radio" name="stars" value="5" id="radio5" onclick="starSetter(5)" required/>
					<label for="radio5"><span id="five"></span></label>
				</span>
			</div>
		</div>

<script>
	function starSetter(x)
	{
		var i;

		for(i = 1; i <= 5; i++)
		{
			var textX;
			switch(i)
			{
				case 1: textX = "one";
					break;
				case 2: textX = "two";
					break;
				case 3: textX = "three";
					break;
				case 4: textX = "four";
					break;
				case 5: textX = "five";
					break;
			}

			if(i <= x)
			{
				document.getElementById(textX).style.backgroundImage = "url('../images/5p_c.svg')";
			}
			else
			{
				document.getElementById(textX).style.backgroundImage = "url('../images/5p_uc.svg')";
			}

		}
	}
</script>

		<div class="item">
			<div class="left" id="mom">
				<label for="review">
					Review:
				</label>
			</div>
			<div class="right" id="tall">
				<textarea id="review" name="review" rows="4" cols="40" required />Review</textarea>
			</div>
		</div>

		<div class="item">
			<div class="left">
			</div>
			<div class="right">
				<input type="submit" value="Send Review">
				<input type="reset" value="Clear" onclick="starSetter(0)" >
			</div>
		</div>

	</form>

</div>

</body>
</html>
