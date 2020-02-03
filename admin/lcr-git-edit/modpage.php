<?php session_start();
$userName = $_SESSION['userName'];
?>
<!DOCTYPE HTML>
<html>
  <head lang="en-AU">
    <link href="Product Sans/stylesheet.css" rel="stylesheet">
    <link rel="stylesheet" href="style.php">
    <?php include 'script.php'; ?>
    <meta charset="UTF-8">
    <title>Local Chat Room</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
  </head>
  <body>
    <?php include 'headerbar.php'; include 'sidebar.php'; ?>
    <h1>Wow, the moderators have their own page!</h1>
  </body>
