<?php session_start(); // Start a session where $_SESSION[] variables can be called from. ?>
<!DOCTYPE html>
<?php
// Grab current username
// $userName = $_SESSION['userName'];
if(!isset($_SESSION['userName'])) {
    $userName = "";
} else {
    $userName = $_SESSION['userName'];
    }

?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Settings</title>
    <link rel="stylesheet" type="text/css" href='style.php'>
    <link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php include 'headerbar.php'; include 'sidebar.php';?>
    <div class="mainContent" style="padding-left:25%;">
      <h3 style="text-align:center;">Before you try using hexadecimals, check out this link <a href="https://www.w3schools.com/colors/colors_picker.asp">W3Schools Colour Picker</a></h3>
      <table style="width:100%;">
        <tr>
          <th colspan="2" style="color:#0696cc;font-size:20px;">Page Styling</th>
          <th colspan="2" style="color:#0696cc;font-size:20px;">Chat Styling</th>
        </tr>
        <tr>
          <form action="Config.php" method="post">
          <th>Background Colour:</th>
          <td><input type="text" autocomplete="off" name="styleBGC" placeholder="#000000" maxlength="10" value="#"></td>
          </form>
          <form action="Config.php" method="post">
          <th>Main Bubble Colour:</th>
          <td><input type="text" autocomplete="off" name="styleMBC" placeholder="#000000" maxlength="10" value="#"></td>
          </form>
        </tr>
        <tr>
          <form action="config.php" method="post">
          <th>Accent Colour:</th>
          <td><input type="text" autocomplete="off" name="styleAC" placeholder="#000000" maxlength="10" value="#"></td>
          </form>
          <form action="config.php" method="post">
          <th>Main Font Colour:</th>
          <td><input type="text" autocomplete="off" name="styleMBFC" placeholder="#000000" maxlength="10" value="#"></td>
          </form>
        </tr>
        <tr>
          <form action="config.php" method="post">
          <th>Header Colour:</th>
          <td><input type="text" autocomplete="off" name="styleHC" placeholder="#000000" maxlength="10" value="#"></td>
          </form>
          <form action="config.php" method="post">
          <th>Secondary Bubble Colour:</th>
          <td><input type="text" autocomplete="off" name="styleSBC" placeholder="#000000" maxlength="10" value="#"></td>
          </form>
        </tr>
        <tr>
          <form action="config.php" method="post">
          <th>General Colour:</th>
          <td><input type="text" autocomplete="off" name="styleC" placeholder="#000000" maxlength="10" value="#"></td>
          </form>
          <form action="config.php" method="post">
          <th>Secondary Font Colour</th>
          <td><input type="text" autocomplete="off" name="styleSBFC" placeholder="#000000" maxlength="10" value="#"></td>
          </form>
        </tr>
      </table>
    </div>
  </body>
</html>
