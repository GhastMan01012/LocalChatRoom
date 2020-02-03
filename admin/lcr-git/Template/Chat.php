<?php session_start(); // Start a session where $_SESSION[] variables can be called from. ?>
<!DOCTYPE html>
<?php
$userName = $_SESSION['userName'];
$currentdir = str_replace("/Users/ethan/Sites", "", getcwd());
$pageCode = str_replace('/chat/Rooms/', "", $currentdir);
?>
	<html>
		<head lang="en-AU">
			<link href="<?php echo $currentdir; ?>/../../../Product Sans/stylesheet.css" rel="stylesheet">
			<link rel="stylesheet" href="style.php">
      <?php include 'script.php'; ?>
			<meta charset="UTF-8">
			<title>Local Chat Room</title>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
		</head>
		<body>
      <?php include 'headerbar.php'; include 'sidebar.php'; ?>
<!-- would you include 'rightSidebar.php'; here? -->
			<div id="chatBox" class="mainContent">
				<iframe id="actualText" src="Transcript.php" style="border:none;height:82.22vh;" width="100%"></iframe>
			</div>
			<?php
			if($userName != "") {
				echo '<table id="bottomBar">
					<tr>
						<td style="width:24vw;">©2020 MilkMGN.<br> All rights reserved.</td>
						<td style="text-align:center;width:76vw;">
							<form action="/chat/Rooms/'.$pageCode.'/Chat.php" method="post">
								<p class="textInput">Send a message to the chat:
									<input name="Enter" autocomplete="off" autofocus="on" maxlength="200" placeholder="Your Message:"></input>
								</p>
							</form>
						</td>
					</tr>
				</table>';
			}
			?>
		</body>
	</html>
