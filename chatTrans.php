<?php session_start();
if(isset($_SESSION['userName'])) {
  $userName = $_SESSION['userName'];
}

$link = mysqli_connect("localhost", "root", "root", "LCR");
$sql = "SELECT msgContent, msgOwner FROM Chat;";
$results = mysqli_query($link, $sql);
while($row = mysqli_fetch_assoc($results)) {
  if($userName==$row["msgOwner"]) {
    echo "<div class='middleleft'><div class='left'>".$row["msgOwner"].": ".$row["msgContent"]."</div></div>\n";
  } else {
    echo "<div class='middleright'><div class='right'>".$row["msgOwner"].": ".$row["msgContent"]."</div></div>\n";
  }
}
?>
