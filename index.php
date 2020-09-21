<?php session_start(); // Start a session where $_SESSION[] variables can be called from. ?>
<!DOCTYPE html>
<?php
if(isset($_SESSION['userName'])) {
	$userName = $_SESSION['userName'];
}
$currentdir = str_replace("C:/xampp/htdocs", "", getcwd());
?>
	<html style='background-color:#efefef;font-family:"Rubik";'>
		<head lang="en-AU">
			<link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
			<link rel="stylesheet" href="style.php">
      <?php include 'script.php'; ?>
			<meta charset="UTF-8">
			<title>Local Chatroom</title>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
		</head>
		<body>
      <?php include 'headerbar.php'; include 'sidebar.php'; ?>
			<div id='usersOnline'>

			</div>
			<div id="chatBox" class="mainContent">
			</div>
			<?php
			if($userName != "") {
				echo '<table id="bottomBar">
					<tr>
						<td style="width:24vw;">©2020 Ethan Foley-Lewis.<br> All rights reserved.</td>
						<td style="text-align:center;width:76vw;">
							<form id="msgBox">
								<p class="textInput">Send a message to the chat:
									<input id="msg" autocomplete="off" autofocus="on" maxlength="200" placeholder="Your Message:"></input>
								</p>
							</form>
						</td>
					</tr>
				</table>';
			}
			?>
			<script>
			function sleep(milliseconds) {
  			const date = Date.now();
  			let currentDate = null;
  			do {
    			currentDate = Date.now();
  			} while (currentDate - date < milliseconds);
			}

			var userName = "<?php echo $userName; ?>";
			var lastMessage = 0;
			var request = "chatTrans.php";

			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if(this.readyState == 4 && this.status == 200) {
					document.getElementById("chatBox").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", request, true);
			xmlhttp.send();

			var response;
			var currentMessage;

			function query() {
				var xmlhttp = new XMLHttpRequest();
			  xmlhttp.onreadystatechange = function() {
			    if(this.readyState == 4 && this.status == 200) {
			      document.getElementById("usersOnline").innerHTML = this.responseText;
			    }
			  };
			  xmlhttp.open("GET", 'functions/online.php', false);
			  xmlhttp.send();

				var request = "chatTrans.php";

				xmlhttp.onreadystatechange = function() {
					if(this.readyState == 4 && this.status == 200) {
						response = this.responseText;
					}
				};
				xmlhttp.open("GET", "functions/lastMessage.php", false);
				xmlhttp.send();

				currentMessage = response.match(new RegExp("<p style='display:none;' id='lastMessage'>" + "(.*)" + "</p>"));
				currentMessage = currentMessage[1];
				sleep(1);

				if(currentMessage > lastMessage) {
					xmlhttp.onreadystatechange = function() {
						if(this.readyState == 4 && this.status == 200) {
							document.getElementById("chatBox").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET", request, false);
					xmlhttp.send();
				}
				lastMessage = currentMessage;

				sleep(100);

				xmlhttp.onreadystatechange = function() {
					if(this.readyState == 4 && this.status == 200) {
					}
				};
				xmlhttp.open("GET", "functions/keepalive.php?username=" + userName, false);
				xmlhttp.send();

				sleep(100);
			}

			var form = document.getElementById("msgBox");
			function handleForm(event) {
				event.preventDefault();
				message = document.getElementById("msg").value;
				document.getElementById("msg").value = "";
				message = "script.php?chat=chat&message=" + message + "&username=" + userName;
				console.log(message);
				xmlhttp.onreadystatechange = function() {
					if(this.readyState == 4 && this.status == 200) {
						console.log('yes')
					}
				};
				xmlhttp.open("GET", message, false);
				xmlhttp.send();
			}
			form.addEventListener('submit', handleForm);

			setInterval(function() {query();}, 1000)
			</script>
		</body>
	</html>
