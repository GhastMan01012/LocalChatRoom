<?php
include '/Users/ethan/Sites/chat/sidebarItems.php';
if($userName != "") {
  $userPerm = $_SESSION['permissions'];
}
?>
<div id="sidebar" class="mainContent">
  <ul>
    <li><a href="Chat.php"><h1>Local Chatroom</h1></a></li>
    <li><h3>Public Rooms -</h3></li>
    <li><a class="barItem" href="/Chat.php">Chat</a></li>
    <?php
    // Write the sidebar items to the side bar (from an array).
    foreach ($mainRooms as $key => $value) {
      echo '<li><a class="barItem" href="'.$value.'">'.$key.'</a></li>';
    }
    ?>
    <li><h3>Additional Pages -</h3></li>
    <li><a class="barItem" href="Config.php">Settings <?php
    if($userName != "") {
      include "/Users/ethan/Sites/chat/accountSettings/$userName/invites.php";
      if(count($userInvites) > 0) {
        $numberOfInvites = count($userInvites);
        echo "<span class='notification'>$numberOfInvites</span>";
      }
    }
    ?></a></li>
    <li><a class="barItem" href="customRoom.php">Create a Room</a></li>
    <li><h3>User Pages -</h3></li>
    <?php
    if($userPerm >= 3) {
      echo '<li><a class="barItem" href="modpage.php">Moderator Page</a></li>';
    }
    if($userPerm >= 4) {
      echo '<li><a class="barItem" href="devpage.php">Developer Page</a></li>';
    }
    if($userPerm == 5) {
      echo '<li><a class="barItem" href="owner.php">Owner\'s Page</a></li>';
    }
    if($userName != "") {
      foreach($registeredRooms as $key => $value) {
        echo '<li><a class="barItem" href="Rooms/'.$key.'/Chat.php">'.$value.'</a></li>';
      }
    }
    ?>
  </ul>
<?php if($_SERVER['PHP_SELF'] == "/Image.php") {
  echo '<form action="Image.php" method="post">
    Send an image to the chat:<input type="text" name="msgImage" placeholder="Insert image URL here.">
  </form>
  <br>
  <form action="Image.php" method="post" enctype="multipart/form-data">
    Select an image to upload:<input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
  </form>';
}; ?>
</div>
