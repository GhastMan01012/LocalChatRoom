<?php
include 'C:/xampp/htdocs/sidebarItems.php';
if($userName != "") {
  include "C:/xampp/htdocs/accountSettings/$userName/roomDatabase.php";
}
$currentdir = str_replace("C:/xampp/htdocs", "", getcwd());
$pageCode = str_replace('/chat/Rooms/', "", $currentdir);
$userPermFile = fopen("C:/xampp/htdocs/accountSettings/$userName/perms.txt", "r+");
$userPerm = fread($userPermFile, filesize("C:/xampp/htdocs/accountSettings/$userName/perms.txt"));
fclose($userPermFile);
?>
<div id="sidebar" class="mainContent">
  <ul>
    <li><h3>Public Rooms -<h3></li>
    <?php
    // Write the sidebar items to the side bar (from an array).
    foreach ($mainRooms as $key => $value) {
      echo '<li><a class="barItem" href="/Chat/'.$value.'">'.$key.'</a></li>';
    }
    ?>
    <li><h3>Additional Pages -</h3><li>
    <li><a class="barItem" href="../../Config.php">Settings </a></li>
    <li><a class="barItem" href="../../customRoom.php">Create a Room<a></li>
    <li><h3>User Pages -</h3></li>
    <?php
    if($userPerm >= 3) {
      echo '<li><a class="barItem" href="/Chat/modpage.php">Moderator Page</a></li>';
    }
    if($userPerm >= 4) {
      echo '<li><a class="barItem" href="/Chat/devpage.php">Developer Page</a></li>';
    }
    if($userPerm == 5) {
      echo '<li><a class="barItem" href="/Chat/owner.php">Owner\'s Page</a></li>';
    }
    foreach($registeredRooms as $key => $value) {
      echo '<li><a class="barItem" href="/Chat/Rooms/'.$key.'/Chat.php">'.$value.'</a></li>';
    }
    ?>
  </ul>
<?php if($_SERVER['PHP_SELF'] == "/Chat/Image.php") {
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
