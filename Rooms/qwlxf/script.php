<?php
// Get the account name and store it in a nicer variable
$userName = $_SESSION['userName'];
// Set timezone to Brisbane, Australia
date_default_timezone_set("Australia/Brisbane");
// Write a bubble shaped div with styling based on client's username to a variable named $Input.
// The if statements in the divs determine how the bubble is displayed per client.
$Input = '<?php session_start(); $userName = $_SESSION['."'userName'".']; ?><div class="outerDiv"><div class="<?php $divSide = "'.$_SESSION['userName'].'"; if ($divSide == $userName) {
  echo "middleleft";
} else {
  echo "middleright";
} ?>"><div id="bottom" class="<?php $divSide = "'.$_SESSION['userName'].'"; if ($divSide == $userName) {
  echo "left";
} else {
  echo "right";
}?>">'.date("H:i")." ".$_SESSION['userName'].": ".$_POST['Enter']."</div></div></div>"."\n".file_get_contents("chatTrans.php"); // Set the next message to contain the txt file
// if "Enter" is posted by the page run the function "textInput" to compile the new file and then write it.
if(isset($_POST['Enter'])) {
  textInput($Input);
}
// Define a function to first, replace any words that are unwanted (case-sensitive, sadly) and then write the chat to the php file.
function textInput($Input) {
  $badWords = array("/sex/", "/Sex/", "/porn/", "/Porn/", "/period/", "/Period/", "/nudes/", "/Nudes/", "/Pussy/", "/pussy/", "/penis/", "/Penis/", "/nigga/", "/Nigga/", "/Porno/", "/porno/", "/nigger/", "/Nigger/",
   "/fuck/", "/Fuck/", "/dick/", "/Dick/");

  $Input = preg_replace($badWords, 'nope', $Input);
  file_put_contents("chatTrans.php", $Input);
}
// Define a function to get rid of unwanted words and then write it to the meme-ery's chat file.
function imgInput($imgInput) {
  $badWords = array("/sex/", "/Sex/", "/porn/", "/Porn/", "/period/", "/Period/", "/nudes/", "/Nudes/", "/Pussy/", "/pussy/", "/penis/", "/Penis/", "/nigga/", "/Nigga/", "/Porno/", "/porno/", "/nigger/", "/Nigger/",
   "/fuck/", "/Fuck/", "/dick/", "/Dick/");

  $imgInput = preg_replace($badWords, 'nope', $imgInput);
  file_put_contents("imgTrans.php", $imgInput);
}
// Detect if "msgImage" is sent and then create a new $imgInput variable containing the new message. Then, write it to the meme-ery chat file.
if(isset($_POST['msgImage'])) {
  $imgInput = '<?php session_start(); $userName = $_SESSION['."'userName'".']; ?><div class="outerDiv"><div class="<?php $divSide = "'.$userName.'"; if ($divSide == $userName) {
    echo "middleleft";
  } else {
    echo "middleright";
  } ?>"><div class="<?php $divSide = "'.$userName.'"; if ($divSide == $userName) {
    echo "left";
  } else {
    echo "right";
  }?>">'.date("H:i")." ".$userName.': '.'<img src="'.$_POST['msgImage'].'">'."</div></div></div>"."\n".file_get_contents("imgTrans.php"); // Add the img tag and the src to the
  imgInput($imgInput);																																																		// txt file with name and time.
}
//Memery Message
$imgInput = '<?php session_start(); $userName = $_SESSION['."'userName'".']; ?><div class="outerDiv"><div class="<?php $divSide = "'.$userName.'"; if ($divSide == $userName) {
  echo "middleleft";
} else {
  echo "middleright";
} ?>"><div class="<?php $divSide = "'.$userName.'"; if ($divSide == $userName) {
  echo "left";
} else {
  echo "right";
}?>">'.date("H:i")." ".$userName.": ".$_POST['imgEnter']."</div></div></div>"."\n".file_get_contents("imgTrans.php"); // Set the next message to contain the txt file
if(isset($_POST['imgEnter'])) {																																										 // and the new message sent.
  imgInput($imgInput);
}
//Image upload scripts

// Where to save the image
$target_dir = "uploadedImgs/";
// Name the file using the file's name
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// Move the file to the correct folder
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
// Send the image to chat (write it to the file)
if(isset($_POST['submit'])) {
  $Input = '<?php session_start(); $userName = $_SESSION['."'userName'".']; ?><div class="outerDiv"><div class="<?php $divSide = "'.$userName.'"; if ($divSide == $userName) {
    echo "middleleft";
  } else {
    echo "middleright";
  } ?>"><div class="<?php $divSide = "'.$userName.'"; if ($divSide == $userName) {
    echo "left";
  } else {
    echo "right";
  }?>">'.date("H:i")." ".$userName.': '.'<img src="'.$target_dir.basename($_FILES["fileToUpload"]["name"]).'">'."</div></div></div>"."\n".file_get_contents("imgTrans.php"); // Add the img tag and the src to the
  imgInput($Input);																																																		// txt file with name and time.
}
?>
