<?php session_start(); // Start a session where $_SESSION[] variables can be called from.
if(isset($_SESSION['userName'])) {
    $userName = $_SESSION['userName'];
}
?>
<!DOCTYPE html>
<html style='font-family:Rubik;'>
  <head>
    <meta charset="utf-8">
    <title>Privacy Notice</title>
    <link rel="stylesheet" type="text/css" href="style.php">
    <link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php include 'headerbar.php'; 
          include 'sidebar.php';
    ?>
    <h1>&nbsp;Privacy</h1>
    <p>
       &nbsp;&nbsp;&nbsp;&nbsp;When you are on this website, your ip is logged by the server (automatic and unavoidable).<br>
       &nbsp;&nbsp;&nbsp;&nbsp;The ip address will not be used to find your general location, although if leaked could be. <br>
       &nbsp;&nbsp;&nbsp;&nbsp;Each account's password is encrypted prior to storing it on the site, so, it is not possible <br>
       &nbsp;&nbsp;&nbsp;&nbsp;for developers or the owner to view that password and use your account. 
    </p>
    <h1>&nbsp;Terms of Service</h1>
    <p>
      &nbsp;&nbsp;&nbsp;&nbsp;Is available to view, <a href="ToS.pdf">here</a>.
    </p>
  </body>
</html>
