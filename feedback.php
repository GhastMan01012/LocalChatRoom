<?php session_start(); // Start a session where $_SESSION[] variables can be called from. ?>
<!DOCTYPE html>
<?php
if(isset($_SESSION['userName'])) {
    $_SESSION['userName'] = $userName;
}
$currentdir = str_replace("C:/xampp/htdocs", "", getcwd());


?>
	<html>
		<head lang="en-AU">
			<link rel="stylesheet" href="style.php">
      <?php include 'script.php'; ?>
			<meta charset="UTF-8">
			<title>Local Chat Room</title>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
		</head>
		<body>
      <?php include 'headerbar.php'; include 'sidebar.php'; ?>
      <form action="feedback.php" method="post">
        Your feedback:<input type="text" name="userFeedback" autocomplete="off"><br>
        <input type="submit" value="Submit Feedback"><br>
        Please note, spamming of feedback will lead to reduced permissions or banning.
      </form>
    </body>
    </html>