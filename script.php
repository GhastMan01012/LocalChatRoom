<?php
// Get the account name and store it in a nicer variable
$userName = $_SESSION['userName'];
// Add a message to database
if(isset($_POST['Enter'])) {
  $link = mysqli_connect("127.0.0.1", "root", "root", "LCR");
  $sql = "INSERT INTO Chat (msgContent, msgOwner) VALUES ('".$_POST['Enter']."', '$userName')";
    if(!mysqli_query($link, $sql)) {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
  // Close connection
  mysqli_close($link);
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
