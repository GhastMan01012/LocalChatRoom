<?php
function defaultify($userName) {
    $link = mysqli_connect("127.0.0.1", "root", "root", "UserSettings");
    $userName_safe = mysql_real_escape_string($conn,  $userName);
    $sql = "INSERT INTO Colours (UserName, MainBubble, MainBubbleFont, SecondaryBubble, SecondaryBubbleFont, BackgroundColour, AccentColour, HeaderColour, GeneralColour) VALUES ('".$userName_safe."', '#d51c46', '#ffffff', '#dfdfdf', '#116280', '#dfdfdf', '#d51c46', '#116280', '#0696cc')";
    if(!mysqli_query($link, $sql)) {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    // Close connection
    mysqli_close($link);
}
function randomColour() {
  $link = mysqli_connect("127.0.0.1", "root", "root", "LCR");
  $check = false;
  while ($check == false) {
    $hexD = Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
    $colour = '';
    for ($i=0; $i < 6; $i++) {
      $index = rand(0, 15);
      $colour .= $hexD[$index];
    }

    $mysql_get_users = mysqli_query($link, "SELECT Colour FROM UserAccounts WHERE Colour = '$colour';");
    $get_rows = mysqli_affected_rows($link);
    if($get_rows < 1) {
      $check = true;
    }
  }
  return $colour;
}
?>
