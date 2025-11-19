<?php
	//Includes
	include_once("./params.php");
	include_once("./dbConfig.php");
	
	//Initialise Database
	session_start();
	$db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
	$db->set_charset("utf8");
	$id="";

	if (isset($_SESSION['id'])) $id=$_SESSION['id'];

	if ($id == NULL) header("Location: logout.php");

	//Get Data from DB
	$query = "SELECT fileName FROM tblFiles WHERE id=$id;";
	$result =  $db->query($query);
	while ($row = $result->fetch_assoc()) {
    	$fileName = $row['fileName'];
  	}
	$result->close();

	$randomFilename = generateRandomFilename(30);

	//Check IF the upload time less than 5 minutes & delete in that case
	$query = "DELETE FROM tblFiles WHERE TIMESTAMPDIFF(MINUTE, uploadDate, NOW()) > 5;";
	echo $query;
	$success = $db->query($query);
	
	//Check success
	if (!$success) header("Location: logout.php");

	echo "$IPSERVER$fileName";
	$qrCreated=eval("qrencode -m 3 -s 50 -d 600 -l M -o /$UPLOADFILES/qr/$randomFilename.png '$IPSERVER$UPLOADFILES'");

	if ($qrCreated) echo "<img src='/$UPLOADFILES/qr/$randomFilename.png' alt='$randomFilename.png'/>";
	else header("Location: logout.php");

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
