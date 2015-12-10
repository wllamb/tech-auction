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
  <!-- jQuery library (served from Google) -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <!-- bxSlider Javascript file -->
  <script src="../js/jquery.bxslider.min.js"></script>
  <!-- bxSlider CSS file -->
  <link href="../js/jquery.bxslider.css" rel="stylesheet" />
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
		<h3>Welcome back <?php echo $_SESSION['name'] ?></h3>
	</div>
	<div class="content">
        <div id="listingImg">
           <img class="round" src="<?php echo $user->picture ?>" height="200" width="200" />
        </div>
    <?php
        $reviews = true;
        $reviewdata = $conn->query('SELECT * FROM reviews WHERE seller='.$userid.' ORDER BY RAND() LIMIT 1');
        $reviewoutput = $reviewdata->fetch_assoc();
        $reviewerID = $reviewoutput['reviewid'];
        $user_review_data = $conn->query('SELECT * FROM google_users WHERE google_id = '.$userid)->fetch_assoc();
        $user_rating = $user_review_data['rating'];
        $max_ratings = $user_review_data['max_ratings'];
        if($max_ratings != 0)
        {
          $stars = (int)(($user_rating/$max_ratings)*100);
        }
        else
        {
          $stars = 0;
          $reviews = false;
        }

        if($stars < 10)
        {
          $startext = '&#9734 &#9734 &#9734 &#9734 &#9734';
        }
        else if(($stars >= 10) && ($stars < 30))
        {
          $startext = '&#9733 &#9734 &#9734 &#9734 &#9734';
        }
        else if(($stars >= 30) && ($stars < 50))
        {
          $startext = '&#9733 &#9733 &#9734 &#9734 &#9734';
        }
        else if(($stars >= 50) && ($stars < 70))
        {
          $startext = '&#9733 &#9733 &#9733 &#9734 &#9734';
        }
        else if(($stars >= 70) && ($stars < 90))
        {
          $startext = '&#9733 &#9733 &#9733 &#9733 &#9734';
        }
        else
        {
          $startext = '&#9733 &#9733 &#9733 &#9733 &#9733';
        }

    ?>

		<p id="rating" title="<?php echo $user_rating.'/'.$max_ratings;?>">
        <?php echo $startext; ?>
		</p>
		<p id="joined">Member since: <?php echo $date ?></p><!-- http://www.alt-codes.net/star_alt_code.php -->

    <?php
    if($reviews) {
      echo '
      <p class="review">
        '.$reviewoutput['review_text'].'
      </p>

      <p class="reviewer">
        <a href="user.php?id='.$reviewerID.'">by: '.$reviewoutput['reviewer'].'</a>
      </p>
      ';
    }
    ?>

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
      <div id="sliderOfLove" style="width: 626; margin: 0 auto 5 auto;">
        <ul class="bxslider">
      <?php

            $slide = 'slideLose';
            $class = 'losing';
            $conditionText = 'Out Bid';

            $result = $conn->query('SELECT * FROM bids WHERE bidderid = '.$userid.'');
            if ($result->num_rows > 0) {
                echo '<center>Sorry no items were found in your search!</center>';
                $itemPosition = 0;
                while ($row = $result->fetch_assoc()) {
                    if ($row['auctionid'] == $itemPosition) {
                      //we do nothing
                    } else {
                        $itemPosition = $row['auctionid'];
                        $resultTwo = $conn->query('SELECT * FROM itemlist WHERE hasended=0 AND id = '.$row['auctionid'].' ');
                        if ($resultTwo->num_rows >= 0) {
                            while ($rowTwo = $resultTwo->fetch_assoc()) {

                            if($_SESSION['user_id'] == $rowTwo['bidderid'])
                            {
                                $slide = 'slideWin';
                                $class = 'winning';
                                $conditionText = 'Highest Bidder';
                            }
                            else
                            {
                                $slide = 'slideLose';
                                $class = 'losing';
                                $conditionText = 'Out Bid';
                            }

                              echo '<li>
                                <div class="boxen">
                                  <img src="../userimages/'.$rowTwo['img'].'" height="200" width="200" class="round '.$class.'" id="one" />
                                  <br />
                                  <span class="'.$slide.'" id="s1" onclick="confirmHandle('.$rowTwo['id'].', 0, 0)">
                                    <h4 class="condition">'.$conditionText.'</h4>
                                    <a><h4 class="rm">Remove</h4></a>
                                  </span>
                                    <a onclick="confirmHandle('.$rowTwo['id'].', 1, 0)"><h4>Remove</h4></a>

                                </div>
                    					</li>';
                            }
                        } else {
                          echo '<center>Sorry no items were found in your search!</center>';

                        }
                    }
                }
            } else {
              echo '<center>Sorry no items were found in your search!</center>';

            }
    ?>
  </ul>
</div>

  <script>
    function confirmHandle(x, rm, list)
    {
      var urlRm = "remove.php?id=";
      var url = "item.php?id=";

      if(!rm)
      {
        window.location.href = url.concat(x);
      }
      else
      {
        var r = confirm("Are you sure you want to remove this item?");
        if (r == true)
        {
          window.location.href = urlRm.concat(x);
        }
        else
        {

        }
      }

    }
  </script>

  <script>
    $(document).ready(function(){
      $('.bxslider').bxSlider(
        {
          moveSlides: 1,
          minSlides: 1,
          maxSlides: 3,
          slideWidth: 202,
          slideMargin: 10
        }
      );
    });
  </script>

        <div id="void"></div>
    </div>

    <div class="title">
        <h3>Items you are selling</h3>
	</div>

  <div class="content">
    <div id="sliderOfLove"  style="width: 626; margin: 0 auto 5 auto;">
      <ul class="bxslider">
    <?php
      $resultThree = $conn->query('SELECT * FROM itemlist WHERE hasended=0 AND ownerid = '.$userid.'');
      if ($resultThree->num_rows > 0) {
          // output data of each row
      while ($row = $resultThree->fetch_assoc()) {

                            echo '<li>
                              <div class="boxen">
                                <img src="../userimages/'.$row['img'].'" height="200" width="200" class="round listing" id="one" />

                                <br />
                                <span class="slideList" id="s1" onclick="confirmHandle('.$row['id'].', 0, 1)">
                                  <h4 class="condition">Listing</h4>
                                  <a><h4 class="rm">Remove</h4></a>
                                </span>
                                <a onclick="confirmHandle('.$row['id'].', 1, 1)" onmouseover="document.getElementByClassName("slideWin").css("opacity", "1")"><h4>Remove</h4></a>

                              </div>
                            </li>';
                          }
          } else {
                  echo '<center>Sorry no items were found in your search!</center>';
          }
  ?>
</ul>
</div>
		<div id="void"></div>
    </div>


</body>
</html>
