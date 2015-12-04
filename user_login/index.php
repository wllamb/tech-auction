<?php
ob_start();
session_start(); //session start
require_once ('libraries/Google/autoload.php');

define("SITE_URL", "http://androntechnologies.com/techauction/user_login/");
define("LOGOUT_URL", "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=". urlencode(SITE_URL."logout.php"));

date_default_timezone_set('America/New_York');
$d = strtotime('now');
$date = date('Y-m-d', $d);

//Insert your cient ID and secret
//You can get it from : https://console.developers.google.com/
$client_id = '421785643835-1te41gear9hb2f36c64spt0t5pl009k5.apps.googleusercontent.com';
$client_secret = 'ivx4T5sNSEy6OuzobCQlT6Ym';
$redirect_uri = 'http://localhost/ta-new/html/account.php';

define('DB_DRIVER', 'mysql');
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'root');
define('DB_SERVER_PASSWORD', '');
define('DB_DATABASE', 'techauction');

$dboptions = array(
    PDO::ATTR_PERSISTENT => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
try {
  $DB = new PDO(DB_DRIVER . ':host=' . DB_SERVER . ';dbname=' . DB_DATABASE, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, $dboptions);
} catch (Exception $ex) {
  echo $ex->getMessage();
  die;
}

/************************************************
  Make an API request on behalf of a user. In
  this case we need to have a valid OAuth 2.0
  token for the user, so we need to send them
  through a login flow. To do this we need some
  information from our API console project.
 ************************************************/
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");

/************************************************
  When we create the service here, we pass the
  client to it. The client then queries the service
  for the required scopes, and uses that when
  generating the authentication URL later.
 ************************************************/
$service = new Google_Service_Oauth2($client);

/************************************************
  If we have a code back from the OAuth 2.0 flow,
  we need to exchange that with the authenticate()
  function. We store the resultant access token
  bundle in the session, and redirect to ourself.
*/

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
  exit;
}

/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}

if (isset($authUrl)){
  //user ins't logged in currently
	$_SESSION["logged_in"] = false;


} else {
  //user authentication key came back, get their info
	$user = $service->userinfo->get(); //get user info
	$_SESSION["name"] = $user->name;
	$_SESSION["email"] = $user->email;
	$_SESSION["picture"] = $user->picture;
	$_SESSION["user_id"] = $user->id;


	//check if user exist in database using COUNT
	$sql = "SELECT COUNT(*) AS count from google_users where google_email = :google_email";
	$stmt = $DB->prepare($sql);
		$stmt->bindValue(":google_email", $user->email);
		$stmt->execute();
		$result = $stmt->fetchAll();

	if ($result[0]["count"] > 0) {
		  // User Exist, so lets capture their data
		  $_SESSION["logged_in"] = true;
		  $_SESSION["name"] = $user->name;
		  $_SESSION["email"] = $user->email;
		  $_SESSION["new_user"] = "no";
    }
	else
	{
   		$sql = "INSERT INTO `google_users` (`google_id`, `google_name`, `google_email`, `google_picture_link`,`joindate`) VALUES " . "( :user_id, :name, :email, :picture, :date)";
			$stmt = $DB->prepare($sql);
			$stmt->bindValue(":user_id", $user->id);
			$stmt->bindValue(":name", $user->name);
			$stmt->bindValue(":email", $user->email);
			$stmt->bindValue(":picture", $user->picture);
      $stmt->bindValue(":date", $date);
			$stmt->execute();
			$_SESSION["new_user"] = "yes";
			echo $mysqli->error;
    }


}


?>
