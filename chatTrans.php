<?php session_start();
if(isset($_SESSION['userName'])) {
  $userName = $_SESSION['userName'];
}

$link = mysqli_connect("127.0.0.1", "root", "root", "LCR");
$sql = "SELECT msgID, msgContent, msgOwner FROM LCR.Chat ORDER BY msgID DESC";
$results = mysqli_query($link, $sql);
while($row = mysqli_fetch_array($results)) {
  if($row['msgOwner'] == $userName) {
    $messageOwned = 'left';
  } else {
    $messageOwned = 'right';
  }
  echo "<div class='".$messageOwned."'>".$row['msgContent']."</div>";
}
?>
