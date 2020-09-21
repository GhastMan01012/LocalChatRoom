<?php
session_start();
// Get the account name and store it in a nicer variable
if(isset($_SESSION['userName'])) {
	$userName = $_SESSION['userName'];
}

include_once 'cnf.php';

function sendMemessage($fileName) {
	$link = mysqli_connect("localhost", "root", "root", "LCR");
	if($fileName == '') {

	} else {
		$msg = "<img max-width=\"480px\" src=\"".$fileName."\">";
	  $sql = "INSERT INTO Meme (msgContent, msgOwner) VALUES ('".$msg."', '". str_replace("'", "\'", $_GET['username']) ."')";
	    if(!mysqli_query($link, $sql)) {
	        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	    }
	  // Close connection
	  mysqli_close($link);
	}
}

// Add a message to database
if(isset($_GET['chat'])) {
  if($_GET['chat'] == 'chat') {
		$link = mysqli_connect($dbHostname, $dbUser, $dbPassword, "LCR");
		if($_GET['message'] == '') {

		} else {
			$msg = str_replace("'", "\'", $_GET['message']);
			$msg = wordwrap($msg, 75, "<br>");
		  $sql = "INSERT INTO Chat (msgContent, msgOwner) VALUES ('".$msg."', '". str_replace("'", "\'", $_GET['username']) ."')";
			echo $sql;
		    if(!mysqli_query($link, $sql)) {
		        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		    }
		  // Close connection
		  mysqli_close($link);
		}
	} else {
		$link = mysqli_connect($dbHostname, $dbUser, $dbPassword, "LCR");
		if($_GET['message'] == '') {

		} else {
			$msg = str_replace("'", "\'", $_GET['message']);
			$msg = wordwrap($msg, 75, "<br>");
		  $sql = "INSERT INTO Meme (msgContent, msgOwner) VALUES ('".$msg."', '". str_replace("'", "\'", $_GET['username']) ."')";
		    if(!mysqli_query($link, $sql)) {
		        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		    }
		  // Close connection
		  mysqli_close($link);
		}
	}
}
// Detect if "msgImage" is sent and then create a new $imgInput variable containing the new message. Then, write it to the meme-ery chat file.
if(isset($_FILES['imgFile'])) {
	$target_dir = "uploadedImgs/";
	$fileType = $_FILES['imgFile']['type'];
	$fileName = $_FILES['imgFile']['name'];

	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));

	$characters = "abcdefghijklmnopqrstuvwyxz1234567890";
	$name = "";
	for ($i=0; $i < 20; $i++) {
		$charIndex = rand(0,35);
		$name .= $characters[$charIndex];
	}
	$fileName = $target_dir.$name.".".$imageFileType;

	if($imageFileType == "png" || $imageFileType == "jpg" || $imageFileType == "jpeg" || $imageFileType == "gif" || $imageFileType == "php") {
		move_uploaded_file($_FILES["imgFile"]["tmp_name"], $fileName);
		sendMemessage($fileName);
	}																																		// txt file with name and time.
}
?>
