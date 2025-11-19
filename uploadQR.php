<?php
	//Includes
	include_once("./params.php");
	include_once("./dbConfig.php");
	
	//Initialise Database
	$db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
	$db->set_charset("utf8");

	$id="";
	if (isset($_SESSION['id'])) $id=$_SESSION['id'];
	else header("Location: logout.php");

	//Get Data from DB
	$query = "SELECT fileName FROM tblFiles WHERE id='$id'";
	echo $query;
	// $results =  $db->query($query);
	$randomFilename = generateRandomFilename(30);

	//Check IF the upload time less than 5 minutes & delete in that case
	$query = "DELETE FROM tblFiles WHERE TIMESTAMP(DAYS,'uploadDate',NOW()) > 5;";
	echo $query;

	// $success = $db->query($query);

	echo "$IPSERVER$UPLOADFILES";
	// eval("qrencode -m 3 -s 50 -d 600 -l M -o /bleutransfert/qr/$randomFilename.png '$IPSERVER$UPLOADFILES'");



	// Function : generate random filename
	function generateRandomFilename($length=20) {
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomFilename = '';
		for ($i = 0 ; $i < $length ; $i++) {
			$randomFilename .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomFilename;
	}




?>
