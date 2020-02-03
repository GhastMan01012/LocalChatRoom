<?php session_start();
$userName = $_SESSION['userName'];
// include relevant files.
if($userName != "") {
  include "C:/xampp/htdocs/latestMessage.php";
  include "C:/xampp/htdocs/accountSettings/$userName/messageViewed.php";

  echo $latestMessageSent - $lastMessageViewed;
}
?>
