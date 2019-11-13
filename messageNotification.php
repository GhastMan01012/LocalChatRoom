<?php session_start();
$userName = $_SESSION['userName'];
// include relevant files.
if($userName != "") {
  include "/Users/ethan/Sites/chat/latestMessage.php";
  include "/Users/ethan/Sites/chat/accountSettings/$userName/messageViewed.php";

  echo $latestMessageSent - $lastMessageViewed;
}
?>
