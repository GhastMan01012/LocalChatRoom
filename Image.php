<?php session_start(); // Start a session where $_SESSION[] variables can be called from.
// $userName = $_SESSION['userName'];
if(!isset($_SESSION['userName'])) {
    $userName = "";
} else {
    $userName = $_SESSION['userName'];
	}
$currentdir = str_replace("C:/xampp/htdocs", "", getcwd());
?>
<!DOCTYPE html>
	<html>
		<head lang="en-AU">
			<meta charset="UTF-8">
			<title>Local Chat Room</title>
			<link href="../Product%20Sans/stylesheet.css" rel="stylesheet">
			<link rel="stylesheet" href="style.php">
			<?php include 'script.php'; ?>
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
			<script>
			window.setInterval(function(){
			  $("#chatNotification").load("/Chat/messageNotification.php");
			}, 1000);
			</script>
		</head>
		<body style="margin:0;">
			<?php include 'headerbar.php'; include 'sidebar.php'; ?>
			<div id="chatBox" class="mainContent">
				<iframe src="imgTranscript.php" style="border:none;" width="100%" height="750px"></iframe>
			</div>
			<div id="bottomBar">
				<div style="padding:none;height:80px;width:24%;border-right:2px solid #efefef;float:left;color:#0696cc;background-color:#efefef;">
					<b>©2020 MilkMGN.<br> All rights reserved.</b>
				</div>
				<div style="float:left;padding:none;background-color:#efefef;color:#0696cc">
					<form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
						<p class="textInput">Send a message to the chat:
							<input name="imgEnter" autocomplete="off" autofocus="on" maxlength="200" placeholder="Your Message:"></input>
						</p>
					</form>
				</div>
			</div>
		</body>
	</html>
