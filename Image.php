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
			<link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
			<link rel="stylesheet" href="style.php">
			<?php include 'script.php'; ?>
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
		</head>
		<body style="margin:0;">
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
						<td style="text-align:center;width:40vw;">
							<form id="msgBox">
								<p class="textInput">Send a message to the chat:
									<input id="msg" autocomplete="off" autofocus="on" maxlength="200" placeholder="Your Message:"></input>
								</p>
							</form>
						</td>
            <td style="text-align:center;width:36vw;">
              <form id="imgBox" enctype="multipart/form-data" method="post">
                <p class="textInput">Send an Image:
                  <input type="file" id="img" name="imgFile"></input>
                  <button type="button" onclick="upload(\''.$userName.'\')">Send</button>
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
			var request = "imgTranscript.php";

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

				var request = "imgTranscript.php";

				xmlhttp.onreadystatechange = function() {
					if(this.readyState == 4 && this.status == 200) {
						response = this.responseText;
					}
				};
				xmlhttp.open("GET", "functions/lastMemessage.php", false);
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
				message = "script.php?chat=img&message=" + message + "&username=" + userName;
				console.log(message);
				xmlhttp.onreadystatechange = function() {
					if(this.readyState == 4 && this.status == 200) {
						console.log('yes');
					}
				};
				xmlhttp.open("GET", message, false);
				xmlhttp.send();
			}
			form.addEventListener('submit', handleForm);

			setInterval(function() {query();}, 1000)

      var form = document.getElementById("imgBox");
      var elm;

		  function upload(uname) {
        elm = document.getElementById('img');
        $.ajax({
          url: "script.php?file=sent&username=" + uname, // Url to which the request is send
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(form), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false
        });
        var xhr = new XMLHttpRequest();
        url = 'script.php?file=sent&username=' + uname;
        fd = new FormData();

        // debug <input>
        if (!elm) {
          console.warn('Element not found');
        } else if (!(elm instanceof HTMLInputElement)) {
          console.warn('Element not an <input>');
        } else if (!elm.files || elm.files.length === 0) {
          console.warn('<input> has no files');
        } else {
          console.info('<input> looks okay');
        }
        // end debug <input>

        fd.append('imgFile', elm.files[0]);

        xhr.addEventListener('load', function () {
          console.log('Response:', this.responseText);
        });

        xhr.open('POST', url);
        xhr.send(fd);
      }
      </script>
		</body>
	</html>
