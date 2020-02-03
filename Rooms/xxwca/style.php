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
  $styleMBC = file_get_contents("C:/xampp/htdocs/accountSettings/$userName/styles/mainBubbleColor.txt");
  $styleSBC = file_get_contents("C:/xampp/htdocs/accountSettings/$userName/styles/secondaryBubbleColor.txt");
  $styleMBFC = file_get_contents("C:/xampp/htdocs/accountSettings/$userName/styles/mainBubbleFontColor.txt");
  $styleSBFC = file_get_contents("C:/xampp/htdocs/accountSettings/$userName/styles/secondaryBubbleFontColor.txt");
  $styleBGC = file_get_contents("C:/xampp/htdocs/accountSettings/$userName/styles/backgroundColor.txt");
  $styleAC = file_get_contents("C:/xampp/htdocs/accountSettings/$userName/styles/accentColor.txt");
  $styleHC = file_get_contents("C:/xampp/htdocs/accountSettings/$userName/styles/headerColor.txt");
  $styleC = file_get_contents("C:/xampp/htdocs/accountSettings/$userName/styles/color.txt");
}
?>
html {
  font-family: 'product_sansregular', verdana;
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
h2 {
  color: #d51c46;
}
h3 {
  margin: 8px;
  color: #d51c46;
}
#brokenPage {
  display: none;
}
#txt {
  margin: 0;
}
.barItem {
  display: block;
  text-decoration: none;
  padding: 10px;
  font-size: 18px;
  color: #0696cc;
  transition: background-color 0.2s, color 0.2s;
}
.barItem:hover {
  background-color: <?php echo $styleBGC ?>;
  color: <?php echo $styleAC ?>;
}
.active {
  color: <?php echo $styleAC ?>;
}
.headerBar {
  display: block;
  float: left;
  text-align: center;
  text-decoration: none;
}
.headerButtons {
  width: 8.33%;
}
#header {
  list-style-type: none;
  color: <?php echo $styleHC ?>;
  background-color: <?php echo $styleBGC ?>;
  margin: 0;
  padding: 0;
  overflow: hidden;
}
#loginButton {
  font-size: 150%;
  text-align: center;
  cursor: pointer;
  margin: 0px;
  transition: background-color 0.2s, color 0.2s;
  padding-top: 25.5px;
  padding-bottom: 25.5px;
}
#loginButton:hover {
  background-color: #ffffff;
  color: <?php echo $styleAC ?>;
}
.loginContent {
  margin-top:25.5px;
  padding:12px;
  text-align:left;
  background-color: <?php echo $styleBGC ?>;
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
#theHeader {
  text-align: center;
  cursor: pointer;
  margin: 0px;
  color: <?php echo $styleHC ?>;
  transition: background-color 0.2s, color 0.2s;
  padding: 0;
  width: 25%;
  height: 80px;
}
#motd {
  width: 50%;
  padding-top: 13px;
  padding-bottom: 13px;
}
#theHeader:hover {
  background-color: #ffffff;
  color: <?php echo $styleAC ?>;
}
#privacyButton {
  text-align: center;
  cursor: pointer;
  transition: background-color 0.2s, color 0.2s;
  color: <?php echo $styleHC ?>;
  padding-top: 31px;
  padding-bottom: 31px;
}
#privacyButton:hover {
  background-color: #ffffff;
  color: <?php echo $styleAC ?>;
}
#registerButton {
  text-align: center;
  cursor: pointer;
  transition: background-color 0.2s, color 0.2s;
  color: <?php echo $styleHC ?>;
  padding-top: 31px;
  padding-bottom: 31px;
}
#registerButton:hover {
  background-color: #ffffff;
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
  height: 747px;
  background-color: #ffffff;
  color: <?php echo $styleC ?>;
  border-right: 0.2vw solid <?php echo $styleBGC ?>;
  text-align: center;
}
#chatBox {
  float: left;
  width: calc(76vw - 17px);
  height: 82.22vh;
}
#actualText {
  seamless: "seamless";
}
#bottomBar {
  bottom: 0;
  position: fixed;
  width: 100%;
  background-color: #efefef;
  height: 8.89vh;
  color: #0696cc;
}
.textInput {
  padding-left: 20px;
  font-size: 25px
}
#loginDropdown {
  position: relative;
  display: inline-block;
}
.loginBox {
  display: none; /* Hidden by default */
  position: absolute; /* Stay in place */
  min-width: 160px; /* Sit on top */
  z-index: 1;
  font-size: 15px;
  background-color: rgba(255,255,255,0);
  transition: display 0.2s;
}
.loginDropdown:hover .loginBox {
  display: block;
}
img {
  max-width: 400px;
}
.left {
  float:left;
  border-radius:5px;
  border:5px solid <?php echo $styleMBC ?>;
  background-color: <?php echo $styleMBC ?>;
  color: <?php echo $styleMBFC ?>;
}
.right {
  float:right;
  border-radius:5px;
  border:5px solid <?php echo $styleSBC ?>;
  background-color: <?php echo $styleSBC ?>;
  color: <?php echo $styleSBFC ?>;
}
.outerDiv {
  height:auto;
  padding: 5px;
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
