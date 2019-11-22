<?php session_start(); // Start a session where $_SESSION[] variables can be called from. ?>
<!DOCTYPE html>
<?php
$userName = $_SESSION['userName'];
$currentdir = str_replace("/Users/ethan/Sites", "", getcwd());
?>
	<html style='background-color:#efefef;'>
		<head lang="en-AU">
			<link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
			<link rel="stylesheet" href="style.php">
      <?php include 'script.php'; ?>
			<meta charset="UTF-8">
			<title>Local Chat Room</title>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
		</head>
		<body>
      <?php include 'headerbar.php'; include 'sidebar.php'; ?>
			<div id="chatBox" class="mainContent">
				<iframe id="actualText" src="Transcript.php" style="border:none;height:82.22vh;" width="100%"></iframe>
			</div>
			<?php
			if($userName != "") {
				echo '<table id="bottomBar">
					<tr>
						<td style="width:24vw;">©2019 localchatroom.ml.<br> All rights reserved. (sorta)</td>
						<td style="text-align:center;width:76vw;">
							<form action="/" method="post">
								<p class="textInput">Send a message to the chat:
									<input name="Enter" autocomplete="off" autofocus="on" maxlength="200" placeholder="Your Message:"></input>
								</p>
							</form>
						</td>
					</tr>
				</table>';
				echo "<div id='updateChatNotification'></div>";
			}
			?>
		</body>
	</html>
