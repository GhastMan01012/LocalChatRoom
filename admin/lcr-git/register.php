<?php session_start(); // Start a session where $_SESSION[] variables can be called from. ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="../Product%20Sans/stylesheet.css" rel="stylesheet">
    <link rel="stylesheet" href="style.php">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <title>Register to the Local Chatroom</title>
  </head>
  <body>
    <?php include 'headerbar.php' ?>
    <div style="text-align:center;">
      <form class="registerForm" action="encrypt.php" method="post">
        <h2>Register</h2>
        <div style="color:#0696cc;">
          <div style="font-size:11px;">Max length is 16 characters</div>
          Username:<input id="username" name="registerUsername" autocomplete="off" autofocus maxlength="16" required><br><br>
          Password:<input id="password" type="password" name="registerPassword" autocomplete="off" maxlength="16" required><br><br>
          You agree to Terms & Conditions (which you can check <a target="_blank" href="Privacy.php">here</a>) <input type="checkbox" name="tos" required><br><br>
          <input style="background-color:#dfdfdf;color:#116280;padding:3px 10px;border:none;" type="submit" value="Register" onClick"return empty()">
        </div>
      </form>
      <script>
      // Make sure the form isn't empty (causes issues, otherwise)
      function empty() {
        var x;
        x = document.getElementById("username").value;
        var y;
        y = document.getElementById("password").value;
        if (x == "") {
          alert("Please provide a username.");
          return false;
        };
        if (y == "") {
          alert("Please provide a password.");
          return false;
        };
      }
      </script>
    </div>
  </body>
</html>
