<k
<?php
    require_once 'dbconnect.php';
    require_once 'cronjob.php';
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

$cat = $_GET['cat'];

switch ($cat) {
    case '0':
        $cat = "CPU's";
        break;
    case '1':
        $cat = 'Cooling';
        break;
    case '2':
        $cat = 'Motherboards';
        break;
    case '3':
        $cat = 'RAM';
        break;
    case '4':
        $cat = 'GPUs';
        break;
    case '5':
        $cat = 'PSUs';
        break;
    case '6':
        $cat = 'Cases';
        break;
    case '7':
        $cat = 'HDDs';
        break;
    case '8':
        $cat = 'SSds';
        break;
    case '9':
        $cat = 'Monitors';
        break;
    case '10':
        $cat = 'Keyboards';
        break;
    case '11':
        $cat = 'Mice';
        break;
    default:
        echo 'Error';
}
?>
<html>
<head>
	<title>Tech Auctions</title>
	<link rel="icon" href="../images/favicon.ico" type="image/x-icon">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/default.css">
  <link rel="stylesheet" type="text/css" href="../css/index.css">
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
		<h3><?php echo $cat; ?></h3>
	</div>
	<div class="content">
	<?php
            //$sql = "SELECT id, category, title, img, price, length, description FROM itemlist WHERE category = ";
            $result = $conn->query('SELECT * FROM itemlist WHERE category = '.$_GET['cat'].' AND hasended = 0');
            if ($result->num_rows > 0) {
                // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '
					<div id="listingImg">
					<a href="item.php?id='.$row['id'].'"><img src="../userimages/'.$row['img'].'" height="128" width="128" class="round" /></a>
					</div>
					<span id="listing">
						<a href="item.php?id='.$row['id'].'" id="titleAuction">'.$row['title'].'</a>
						<a href="item.php?id='.$row['id'].'" id="price">$'.$row['price'].'</a>
						<h4><a href="#">Seller: '.$row['ownername'].'</a></h4>
						<a href="item.php?id='.$row['id'].'"><p>'.$row['description'].'</p></a>
					</span>
					<div id="void"></div>
					<hr />
				';
            }
            } else {
                echo '<center>Sorry no items were found in your search!</center>';
            }

    ?>
	</div>
	<div id="void"></div>
</div>

</body>
</html>
