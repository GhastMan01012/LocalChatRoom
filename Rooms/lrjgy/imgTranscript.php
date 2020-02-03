<!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
window.setInterval(function(){
  $("#txt").load("imgTrans.php");
}, 1000);
</script>
<html>
  <head>
    <meta encoding="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.php">
  </head>
  <body style="font-family:helvetica;color:black">
    <p id="txt"></p>
  </body>
</html>
