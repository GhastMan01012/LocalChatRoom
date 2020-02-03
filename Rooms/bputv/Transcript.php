<?php session_start(); // Start a session where $_SESSION[] variables can be called from.
$userIP = $_SERVER['REMOTE_ADDR']
?>
<!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
window.setInterval(function(){
  $("#txt").load("chatTrans.php#bottom");
}, 1000);
</script>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.php">
    <meta encoding="utf-8">
    <title></title>
  </head>
  <body style="font-family:helvetica;color:black;margin:0;">
    <p id="txt" style="margin:0;"></p>
  </body>
</html>
