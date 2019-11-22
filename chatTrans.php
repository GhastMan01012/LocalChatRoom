<?php session_start();
if(isset($_SESSION['userName'])) {
  $userName = $_SESSION['userName'];
}

$link = mysqli_connect("localhost", "root", "root", "LCR");
$sql = "SELECT msgID, msgContent, msgOwner FROM LCR.Chat ORDER BY msgID DESC";
$results = mysqli_query($link, $sql);
while($row = mysqli_fetch_array($results)) {
  echo "$row['msgContent']";
}
?>
