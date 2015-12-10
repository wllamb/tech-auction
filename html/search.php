<?php
require_once 'dbconnect.php';
require_once 'cronjob.php';
require_once '../user_login/index.php';

// unset if after it display the error.
$_SESSION['e_msg'] = '';

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
    <link rel="stylesheet" type="text/css" href="../css/list.css">
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
		<h3>Search Results</h3>
	</div>
	<div class="content">
	<?php
            if (isset($_GET['go'])) {
                if (preg_match('/^[  a-zA-Z0-9]+/', $_POST['name'])) {
                    $name = $_POST['name'];
                          //-query  the database table
                          $sql = "SELECT * FROM itemlist WHERE hasended=0 AND title LIKE '%".$name."%' OR description LIKE '%".$name."%'";
                          //-run  the query against the mysql query function
                          $result = $conn->query($sql);
                          //-create  while loop and loop through result set
                          if ($result->num_rows > 0) {
                              while ($rowTwo = $result->fetch_assoc()) {
                                  echo '
                                  <div id="listingImg">
                                  <a href="item.php?id='.$rowTwo['id'].'"><img src="../userimages/'.$rowTwo['img'].'" height="128" width="128" class="round" /></a>
                                  </div>
                                  <span id="listing">
                                    <a href="item.php?id='.$rowTwo['id'].'" id="titleAuction">'.$rowTwo['title'].'</a>
                                    <a href="item.php?id='.$rowTwo['id'].'" id="price">$'.$rowTwo['price'].'</a>
                                    <h4><a href="user.php?id='.$rowTwo['ownerid'].'">Seller: '.$rowTwo['ownername'].'</a></h4>
                                    <a href="item.php?id='.$rowTwo['id'].'"><p>'.$rowTwo['description'].'</p></a>
                                  </span>
                                  <div id="void"></div>
                                  <hr />
                                  ';
                              }
                          } else {
                              echo '<center>Sorry no items were found in your search!</center>';
                          }
                } else {
                    echo '<center>Sorry no items were found in your search!</center>';
                }
            }
    ?>
	</div>
	<div id="void"></div>
</div>

</body>
</html>
