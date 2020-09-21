<?php
$link = mysqli_connect("localhost", "root", "root", "LCR");
$sql = "SELECT msgID FROM LCR.Chat ORDER BY msgID ASC";
$results = mysqli_query($link, $sql);
$lastMessage = 0;

while($row = mysqli_fetch_array($results)) {
  $lastMessage = $row['msgID'];
}
?>
<p style='display:none;' id='lastMessage'><?php echo $lastMessage; ?></p>
