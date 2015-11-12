<?php
date_default_timezone_set("America/New_York");

require_once('dbconnect.php');
require_once ('../user_login/index.php');


	$result = $conn->query('SELECT * FROM itemlist WHERE hasended = 0');//hit item database & return all items that haven't ended
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$startDate = strtotime("".$row["dateposted"]."");//set start date
			$endDate = strtotime("+".$row["length"]." days","$startDate"); //set end date based on auction length value
			$timeNow = strtotime('now'); //sets up time now
			if($timeNow >= $endDate)
			{
				//auction should end if this condition is met
				$sql = "UPDATE itemlist SET hasended=1 WHERE id=".$row["id"]; //sets auction to end, now we send emails..
				//Email information
				$winner_email = $row["biddername"]."@gmail.com";
				$owner_email = $row["ownername"]."@gmail.com";
				$email = "TechAuctions@techauction.co.nr";
				$subject_winner = "You won the item!";
				$subject_owner = "Your TechAcution item sold!";
				$subject_owner_nosell = "Your TechAcution item didn't sell";
				$comment = "Congratulations!";
				$comment_nosell = "Sorry! Your item didn't sell. Please re-list it!";

				  //send emails
					if($row["bidnum"] == 0)
					{
						//auction has no winner, so send seller an email saying didn't sell
						mail($owner_email, "$subject_owner_nosell", $comment_nosell, "From:" . $email);
					} else {
						mail($winner_email, "$subject_winner", $comment, "From:" . $email);
					  mail($owner_email, "$subject_owner", $comment, "From:" . $email);
					}
				if ($conn->query($sql) === TRUE) {
					echo "Record updated successfully";
				} else {
					echo "Error updating record: " . $conn->error;
				}
			} else {
				//auction should continue because time hasn't expired

			}
		}
	} else {
			//echo "Database error";
	}

?>
