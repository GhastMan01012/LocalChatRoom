<?php session_start();
if(isset($_SESSION['userName'])) {
  $userName = $_SESSION['userName'];
}
$link = mysqli_connect("127.0.0.1", "root", "", "LCR");
$sql = "SELECT msgID, msgContent, msgOwner FROM lcr.chat ORDER BY msgID DESC";
$results = mysqli_query($link, $sql);
while($row = mysqli_fetch_array($results)) {
  if($row['msgOwner'] == $userName) {
    $messageOwned = 'left';
    $messageOwned2 = 'middleleft';
  } else {
    $messageOwned = 'right';
    $messageOwned2 = 'middleright';
  }
  echo "<div class='outerDiv'><div class='".$messageOwned2."'><div class='".$messageOwned."'>".$row['msgOwner'].": ".$row['msgContent']."</div></div></div>";
}
?>
