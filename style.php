<?php session_start(); // Start a session where $_SESSION[] variables can be called from.
    header("Content-type: text/css; charset: UTF-8");
    $userName = $_SESSION['userName'];
?>
<?php
// If the user isn't logged in, default to default styling.
if($userName == "") {
  $styleMBC = "#d51c46";
  $styleSBC = "#dfdfdf";
  $styleMBFC = "#ffffff";
  $styleSBFC = "#116280";
  $styleBGC = "#dfdfdf";
  $styleAC = "#d51c46";
  $styleHC = "#116280";
  $styleC = "#0696cc";
} else { // If the user is logged in, use styles from their preferences.
    $link = mysqli_connect("localhost", "root", "root", "UserSettings");
    $sql = "SELECT MainBubble, MainBubbleFont, SecondaryBubble, SecondaryBubbleFont, BackgroundColour, AccentColour, HeaderColour, GeneralColour FROM Colours WHERE UserName = '$userName'";
    $results = mysqli_query($link, $sql);
    // Turn the data into an array where each key is a column in the table
    $data = mysqli_fetch_assoc($results);
    // Write the database info to a variable so it can be called to style the page
    $styleMBC = $data['MainBubble'];
    $styleSBC = $data['SecondaryBubble'];
    $styleMBFC = $data['MainBubbleFont'];
    $styleSBFC = $data['SecondaryBubbleFont'];
    $styleBGC = $data['BackgroundColour'];
    $styleAC = $data['AccentColour'];
    $styleHC = $data['HeaderColour'];
    $styleC = $data['GeneralColour'];
}
?>
html {
  font-family: 'Rubik', verdana;
}
body {
  margin: 0;
  background-color: #ffffff;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 100%;
}
a {
  text-decoration: none;
}
#sidebar ul a:visited {
  color: #0696cc;
  text-decoration: underline;
}
nav ul li a {
  color: black;
}
h2 {
  color: #0696cc;
}
h3 {
  margin: 8px;
  color: #d51c46;
}
nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  border-bottom: 1px solid black;
}
nav ul li {
  float: right;
  padding: 3vh 1vw;
}
nav {
    background-color: <?php echo $styleBGC; ?>;
}
#txt {
  margin: 0;
}
.active {
  color: <?php echo $styleAC ?>;
}
#chatButton {
  text-align: center;
  cursor: pointer;
  margin: 0;
  transition: background-color 0.2s, color 0.2s;
  padding: 0;
}
#chatButton:hover {
  background-color: <?php echo $styleBGC ?>;
  color: <?php echo $styleAC ?>;
}
#userInput {
  height: 20px;
  width: 200px;
  font-size: 18px;
}
#sidebar {
  float: left;
  width: 23.8vw;
  height: calc(100vh - 8.89vh - 4.364vh);
  background-color: #ffffff;
  color: <?php echo $styleC ?>;
  border-right: 1px solid black;
  text-align: center;
}
.notification {
  width: 21px;
  background-color: <?php echo $styleAC; ?>;
  color: #ffffff;
  border-radius: 10.5px;
  display: inline-block;
}
#chatBox {
  float: left;
  width: calc(76vw - 17px);
  height: 82.22vh;
  background-color: #efefef;
}
#actualText {
  seamless: "seamless";
}
#bottomBar {
  bottom: 0;
  position: fixed;
  width: 100%;
  background-color: white;
  height: 8.89vh;
  color: black;
  border: 1px solid black;
}
.textInput {
  padding-left: 20px;
  font-size: 25px
}
#loginForm {
  display: none;
}
#loginItem + #loginForm {
  display: list-item;
}
#loginForm {
  display: list-item;
}
#loginForm:focus {
  display: list-item;
}
img {
  max-width: 400px;
}
.left {
  float:left;
  border-radius: 12px;
  border:2px solid;
  background-color: white;
  color: black;
  padding: 4px;
}
.right {
  float:right;
  border-radius:12px;
  border: 2px solid;
  background-color: white;
  color: #000000;
  padding: 4px;
}
.outerDiv {
  height:auto;
  margin: 5px;
}
.middleleft {
  min-width: 51%;
  float: left;
  margin: 3px;
}
.middleright {
  min-width: 51%;
  float: right;
  margin: 3px;
}
