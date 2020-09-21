<div style='margin-top:0.5vh;margin-bottom:0.5vh;'>
  <div style='float:left;margin-right:0.5vw;'>
    Users Currently Online:
  </div>
<?php
$link = mysqli_connect("localhost", "root", "root", "LCR");

date_default_timezone_set('Australia/Brisbane');
$date = date('Y-m-d H:i:s', time() - 5);
$sql = "SELECT UserID FROM LastOnline WHERE LastOnline >= '".$date."';";
if(!mysqli_query($link, $sql)) {
  echo "ERROR: Could not able to execute $sql.".mysqli_error($link);
}

$results = mysqli_query($link, $sql);
while($row2 = mysqli_fetch_array($results)) {
  $sql = "SELECT UserName FROM UserAccounts WHERE UserID =".$row2['UserID'].";";
  $results2 = mysqli_query($link, $sql);
  $data2 = mysqli_fetch_assoc($results2);
  echo "<div style='float:left;border:1px solid #0696cc;border-radius:8px;margin-right:0.5vw;padding-left:0.2vw;padding-right:0.2vw;'>".$data2['UserName']."</div>";
}
?>
</div>
