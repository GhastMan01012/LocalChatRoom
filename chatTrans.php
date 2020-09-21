<?php session_start();
if(isset($_SESSION['userName'])) {
  $userName = $_SESSION['userName'];
} else {
    $userName = "";
}
$link = mysqli_connect("localhost", "root", "root", "LCR");

$sql = "SELECT msgID, msgContent, msgOwner FROM LCR.Chat ORDER BY msgID DESC LIMIT 50";
$results = mysqli_query($link, $sql);
$lastMessage = 0;

while($row = mysqli_fetch_array($results)) {
  $sql2 = "SELECT Colour FROM LCR.UserAccounts WHERE UserName = '".$row['msgOwner']."';";
  $results2 = mysqli_query($link, $sql2);

  $row2 = mysqli_fetch_array($results2);

  if($row['msgOwner'] == $userName) {
    $messageOwned = 'left';
    $messageOwned2 = 'middleleft';
  } else {
    $messageOwned = 'right';
    $messageOwned2 = 'middleright';
  }
  echo "<div class='outerDiv'><div class='".$messageOwned2."'><div style='border-color:#".$row2['Colour'].";' class='".$messageOwned."'>".$row['msgOwner'].": ".$row['msgContent']."</div></div></div>";
  if($lastMessage < $row['msgID']) {
    $lastMessage = $row['msgID'];
  }
}
?>
