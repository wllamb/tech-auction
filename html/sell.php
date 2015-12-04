<?php
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

<html>
<head>
	<title>Tech Auctions</title>
	<link rel="icon" href="../images/favicon.ico" type="image/x-icon">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/default.css">
    <link rel="stylesheet" type="text/css" href="../css/sell.css">
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
		<h3>List an Item</h3>
	</div>
	<form class="content" action="listItem.php" method="post" enctype="multipart/form-data">
		<div class="item">
			<div class="left">
				<label for="category">
					Category:
				</label>
			</div>
			<div class="right">
				<select id="category" name="cat" required>

					<option value="0">CPU</option>
					<option value="1">Cooling</option>
					<option value="2">MOBO</option>
					<option value="3">RAM</option>
					<option value="4">GPU</option>
					<option value="5">PSU</option>
					<option value="6">Case</option>
					<option value="7">HDD</option>
					<option value="8">SSD</option>
					<option value="9">Monitor</option>
					<option value="10">Keyboard</option>
					<option value="11">Mouse</option>
				</select>
			</div>
		</div>

		<div class="item">
			<div class="left">
				<label for="item">
					Item:
				</label>
			</div>
			<div class="right">
				<input type="text" id="item" name="item" required />
			</div>
		</div>

		<div class="item">
			<div class="left">
				<label for="imageUp">
					Image:
				</label>
			</div>
			<div class="right">
				<input type="file" id="imageUp" name="image" required />
			</div>
		</div>

		<div class="item">
			<div class="left">
				<label for="bid">
					Starting Bid:
				</label>
			</div>
			<div class="right">
				<input type="text" id="bid" name="bid" value="$0.00" required/>
			</div>
		</div>

		<div class="item">
			<div class="left">
				<label for="length">
					Auction Length (Days):
				</label>
			</div>
			<div class="right">
				<select id="length" name="length" required>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7" selected>7</option>
				</select>
			</div>
		</div>

		<div class="item">
			<div class="left" id="mom">
				<label for="description">
					Description:
				</label>
			</div>
			<div class="right" id="tall">
				<textarea id="description" name="description" rows="4" cols="40">Item Description</textarea>
			</div>
		</div>

		<div class="item">
			<div class="left">
			</div>
			<div class="right">
				<input type="submit" value="List Item">
				<input type="button" value="Clear">
			</div>
		</div>

	</form>

</div>

</body>
</html>
