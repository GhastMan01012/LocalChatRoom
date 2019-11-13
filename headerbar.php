<ul id="header">
  <a href="Chat.php"><li id="theHeader" class="headerBar active"><h1>Local Chat Room</h1></li></a>
  <li class="headerBar" id="motd">Welcome<?php if(isset($_SESSION['userName'])) {echo ", ".$_SESSION['userName'];} else {echo " to the Local Chatroom";}; ?>!<br><br>Ethan is currently doing development.</li>
  <li class="headerBar headerButtons"><a href="Privacy.php"><div id="privacyButton">Policies</div></a></li>
  <li class="headerBar loginDropdown headerButtons" id="loginButton">Login
  <div class="loginBox">
    <div class="loginContent">
      <form action="encrypt.php" method="post">
      <input id="userInput" autocomplete="off" autofocus="on" name="loginUsername" placeholder="Username" maxlength="16"><br>
      <input id="userInput" type="password" name="loginPassword" placeholder="Password" maxlength="16">
      <input type="submit" value='Log In'>
      </form></li>
    </div>
  </div>
  <li class="headerBar headerButtons"><a href="register.php"><div id="registerButton">Register</div></a></li>
</ul>
<script type="text/javascript">
var modal = document.getElementById('modal');

var btn = document.getElementById("loginButton");

var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
  modal.style.display = "block";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
