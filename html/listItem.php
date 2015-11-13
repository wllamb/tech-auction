<?php
    require_once 'dbconnect.php';
    require_once '../user_login/index.php';

/* This grabs the current date & time the auction was created */

date_default_timezone_set('America/New_York');
$d = strtotime('now');
$date = date('Y-m-d h:i:sa', $d);
$imageDate = date('Y_m_d_h_i_sa', $d);

/*  ********************************************************  */
$temp = explode('.', $_FILES['image']['name']);
$extension = end($temp);
$newFileName = rtrim($_SESSION['email'], '@gmail.com') . $imageDate.'.'.$extension;
$category = $_POST['cat']; //works
$title = $_POST['item']; //works
$imgLink = $newFileName; //works
$startPrice = trim($_POST['bid'], '$'); // only delete $ at start or end of the string
$length = $_POST['length']; // works
$desc = $_POST['description']; //works
$owner = $_SESSION['user_id'];
$ownerName = rtrim($_SESSION['email'], '@gmail.com');
$currentbidder = 'No one has bid on this item';
$sql = "INSERT INTO itemlist (category, title, img, price, length, description, ownerid, dateposted, bidderid, biddername, ownername)
VALUES ('$category', '$title', '$imgLink', '$startPrice', '$length', '$desc', '$owner', '$date', '$currentbidder', '$currentbidder','$ownerName');";

        if ($conn->query($sql) === true) {
            $last_id = $conn->insert_id; // gets the items id#

            $target_dir = '../userimages/';
            $target_file = $target_dir.basename($_FILES['image']['name']);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if (isset($_POST['submit'])) {
                $check = getimagesize($_FILES['image']['tmp_name']);
                if ($check !== false) {
                    echo 'File is an image - '.$check['mime'].'.';
                    $uploadOk = 1;
                } else {
                    echo 'File is not an image.';
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo 'Sorry, file already exists.';
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES['image']['size'] > 500000000) {
                echo 'Sorry, your file is too large.';
                $uploadOk = 0;
            }
            // Allow certain file formats
            if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
                echo 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo 'Sorry, your file was not uploaded.';

            // if everything is ok, we try to upload file...
            } else {
                $temp = explode('.', $_FILES['image']['name']);
                $extension = end($temp);
                $newFileName = rtrim($_SESSION['email'], '@gmail.com') . $imageDate.'.'.$extension;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $newFileName)) {
                    echo 'The file '.basename($_FILES['image']['name']).' has been uploaded.';
                        // Input the remaining fields into the SQL TABLE "ITEMLIST"
                } else {
                    echo 'Sorry, there was an error uploading your file.';
                }
            }
            echo '
								<SCRIPT language="JavaScript">
								<!--
								window.location="../html/success.php?id='.$last_id.'";
								//-->
								</SCRIPT>
								';//end html echo
        } else {
            echo 'Error: '.$sql.'<br>'.$conn->error;
        }

$conn->close();
