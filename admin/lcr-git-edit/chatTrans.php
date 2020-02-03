<?php session_start();
if(isset($_SESSION['userName'])) {
  $userName = $_SESSION['userName'];
}

$link = mysqli_connect("localhost", "root", "milkmgn", "LCR");
$sql = "SELECT msgID, msgContent, msgOwner FROM LCR.Chat ORDER BY msgID DESC";
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
