<?php session_start(); // Start a session where $_SESSION[] variables can be called from.
$userIP = $_SERVER['REMOTE_ADDR'];
$userName = $_SESSION['userName'];
?>
<!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
\\window.setInterval(function(){
\\  $("#txt").load("chatTrans.php");
\\}, 1000);
</script>
<html style='background-color:#efefef;'>
  <head>
    <link rel="stylesheet" type="text/css" href="style.php">
    <meta encoding="utf-8">
    <title></title>
    <link href="Product Sans/stylesheet.css" rel="stylesheet">
  </head>
  <body style="font-family:'product sans';color:black;margin:0;">
    <p id="txt" style="margin:0;">
    </p>
  </body>
</html>
