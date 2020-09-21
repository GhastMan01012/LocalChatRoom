<?php
$userName = $_GET['username'];

$link = mysqli_connect("127.0.0.1", "root", "root", "LCR");

$sql = "SELECT UserID FROM UserAccounts WHERE UserName = '".$userName."';";
if(!mysqli_query($link, $sql)) {
  echo "ERROR: Could not able to execute $sql.".mysqli_error($link);
}
$results = mysqli_query($link, $sql);
$data = mysqli_fetch_assoc($results);

$sql2 = "UPDATE LastOnline SET LastOnline = now() WHERE UserID = ".$data['UserID'];
if(!mysqli_query($link, $sql2)) {
  echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
