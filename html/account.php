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

        date_default_timezone_set('America/New_York');
        $result = $conn->query('SELECT * FROM google_users WHERE google_id = '.$userid);
        $item = $result->fetch_assoc();
        $joindate = $item['joindate'];
        $d = strtotime($joindate);
        $date = date('m-d-Y', $d);

?>
<html>
<head>
	<title>Tech Auctions</title>
	<link rel="icon" href="../images/favicon.ico" type="image/x-icon">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/default.css">
	<link rel="stylesheet" type="text/css" href="../css/account.css">
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
		<h3>Welcome <?php echo $_SESSION['name'] ?></h3>
	</div>
	<div class="content">
        <div id="listingImg">
           <img class="round" src="../images/cpu.png" height="200" width="200" />
        </div>
        <!--span id="listing">
            <p>Your display name is: herpaderp</p>
            <p>The email address on file is: herpaderp@gmail.com</p>
        </span-->

		<p id="rating" title="17/20">
			&#9733 &#9733 &#9733 &#9733 &#9734
		</p>
		<p id="joined">Member since: <?php echo $date ?></p><!-- http://www.alt-codes.net/star_alt_code.php -->

		<p class="review">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur cursus eleifend orci eu pretium. Vestibulum efficitur vitae metus id lobortis. Aliquam vel fringilla nibh. Praesent ac tincidunt sapien. In a metus dolor. Vestibulum eu dictum metus. Praesent malesuada dui magna, eu iaculis velit lacinia et. Donec finibus ante id nisl placerat, vitae ultrices nunc convallis. Vivamus at risus mi. In in diam quis ipsum consectetur semper vitae quis risus.
		</p>

		<p class="reviewer">
			<a href="#"> - ponlyloverx67</a>
		</p>

		<div id="void"></div>
    </div>

<?php
    $result = $conn->query('SELECT * FROM itemlist WHERE hasended = 1 AND reviewleft = 0 AND bidderid ='.$userid);
    if ($result->num_rows > 0) {
    echo '
    <div>

      <div class="title">
    		<h3>Pending Reviews</h3>
    	</div>

      <div class="content">
          <ul>
          ';
            while ($row = $result->fetch_assoc()) {
              echo '<li><a href="review.php?id='.$row['id'].'">'.$row['title'].'</a></li>';
            }
          echo '
          </ul>
      </div>

    </div>
    ';
  }
?>
	<div class="title">
		<h3>Items you are bidding on</h3>
	</div>

    <div class="content">
		<div class="navBox">
			<span class="navL">
				<a width="50" height="50"></a>
			</span>

			<div class="boxen">
				<img src="../images/mobo.png" height="200" width="200" class="round winning" id="one" />
				<img src="../images/cpu.png" height="200" width="200" class="round losing" id="two" />
				<img src="../images/monitor.png" height="200" width="200" class="round losing" id="three" />

				<br />

				<span class="slideWin" id="s1" onclick="window.location = '#';">
					<h4 class="condition">Highest Bidder</h4>
					<a href="#rm"><h4 class="rm">Remove</h4></a>
				</span>

				<span class="slideLose" id="s2" onclick="window.location = '#';">
					<h4 class="condition">Out Bid</h4>
					<a href="#rm"><h4 class="rm">Remove</h4></a>
				</span>

				<span class="slideLose" id="s3" onclick="window.location = '#yolo';">
					<h4 class="condition">Out Bid</h4>
					<h4 class="rm" onclick="confirm('Are you sure you want to remove this item?')">Remove</h4>
				</span>
			</div>

			<span class="navR">
				<a width="50" height="50"></a>
			</span>
		</div>
        <div id="void"></div>
    </div>

    <div class="title">
        <h3>Items you are selling</h3>
	</div>

    <div class="content">
		<div class="navBox">
			<span class="navL">
				<a width="50" height="50"></a>
			</span>

			<div class="boxen">
				<img src="../images/mobo.png" height="200" width="200" class="round listing" id="lOne" />
				<img src="../images/cpu.png" height="200" width="200" class="round listing" id="lTwo" />
				<img src="../images/monitor.png" height="200" width="200" class="round listing" id="lThree" />

				<br />

				<span class="slideList" id="sl1" onclick="window.location = '#';">
					<h4 class="condition">Listing</h4>
					<a href="#lrm1"><h4 class="rm">Remove</h4></a>
				</span>

				<span class="slideList" id="sl2" onclick="window.location = '#';">
					<h4 class="condition">Listing</h4>
					<a href="#lrm2"><h4 class="rm">Remove</h4></a>
				</span>

				<span class="slideList" id="sl3" onclick="window.location = '#';">
					<h4 class="condition">Listing</h4>
					<a href="#lrm3"><h4 class="rm">Remove</h4></a>
				</span>
			</div>

			<span class="navR">
				<a width="50" height="50"></a>
			</span>
		</div>
		<div id="void"></div>
    </div>


</body>
</html>
