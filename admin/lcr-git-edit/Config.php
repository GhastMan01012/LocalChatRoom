<?php session_start(); // Start a session where $_SESSION[] variables can be called from. ?>
<!DOCTYPE html>
<?php
include 'rooms.php';
// Define a function to get rid of ascii hexadecimal values from http_build_query above (see, ascii.cl for info)
function noAscii($string) {
  $string = str_replace("+", " ", $string);
  $string = str_replace("%21", "!", $string);
  $string = str_replace("%22", '"', $string);
  $string = str_replace("%23", "#", $string);
  $string = str_replace("%24", "$", $string);
  $string = str_replace("%25", "%", $string);
  $string = str_replace("%26", "&", $string);
  $string = str_replace("%27", "'", $string);
  $string = str_replace("%28", "(", $string);
  $string = str_replace("%29", ")", $string);
  $string = str_replace("%2A", "*", $string);
  $string = str_replace("%2B", "+", $string);
  $string = str_replace("%2C", ",", $string);
  $string = str_replace("%2D", "-", $string);
  $string = str_replace("%2E", ".", $string);
  $string = str_replace("%2F", "/", $string);
  $string = str_replace("%3A", ":", $string);
  $string = str_replace("%3B", ";", $string);
  $string = str_replace("%3C", "<", $string);
  $string = str_replace("%3D", "=", $string);
  $string = str_replace("%3E", ">", $string);
  $string = str_replace("%3F", "?", $string);
  $string = str_replace("%40", "@", $string);
  $string = str_replace("%5B", "[", $string);
  $string = str_replace("%5C", "\\", $string);
  $string = str_replace("%5D", "]", $string);
  $string = str_replace("%5E", "^", $string);
  $string = str_replace("%5F", "_", $string);
  $string = str_replace("%60", "`", $string);
  $string = str_replace("%7B", "{", $string);
  $string = str_replace("%7C", "|", $string);
  $string = str_replace("%7D", "}", $string);
  $string = str_replace("%7E", "~", $string);
  $string = str_replace("%7F", "", $string);
  return $string;
}
function dbQueryInsertWhere($location, $user, $pass, $dbName, $table, $identifierKey, $identifierValue, $column, $value) {
    $link = mysqli_connect("$location", "$user", "$pass", "$dbname");
    $sql = "SELECT $column FROM UserAccounts WHERE UserKey = $encrypted AND UserName = '$userName'";
    $results = mysqli_query($link, $sql);
    // Turn the data into an array where each key is a column in the table
    $data = mysqli_fetch_assoc($results);
};
// Define a function to remove a key and its value from a file.
function takeArrayFromFile($oldList, $key, $fileName, $name) {
  unset($oldList[$key]);
  $newList = http_build_query($oldList, '', ', ');
  $newList = noAscii($newList);
  if($newList == "0=") {
    $arrayFile = fopen("$fileName", "w");
    fwrite($arrayFile, "<?php ".'$'.$name.' = array(); ?>');
    fclose($arrayFile);
  } elseif($newList == "") {
    $arrayFile = fopen("$fileName", "w");
    fwrite($arrayFile, "<?php ".'$'.$name.' = array(); ?>');
    fclose($arrayFile);
  } else {
    $newList = str_replace("=", "=>", "$newList");
    $newList = '"'.$newList;
    $newList = str_replace("=>", '"=>"', $newList);
    $newList = str_replace(", ", '", "', $newList);
    $arrayFile = fopen("$fileName", "w");
    fwrite($arrayFile, "<?php ".'$'.$name.' = array('.$newList.'"); ?>');
    fclose($arrayFile);
  }
};
// Define a function to write an list to a file.
function listToFile($oldList, $value, $fileName, $name) {
  $oldList[] = $value;
  $newList = implode('", "', $oldList);
  $arrayFile = fopen("$fileName", "w");
  fwrite($arrayFile, "<?php ".'$'.$name.' = array("'.$newList.'"); ?>');
  fclose($arrayFile);
};
// Define a function to write a users style preferences to the applicable file.
function styleInput($styleName, $styleContents, $userName) {
  $styleDir = dirname(__FILE__)."/accountSettings/$userName/styles/$styleName.txt";
  $newStyle = fopen($styleDir, "c+");
  fwrite($newStyle, $styleContents);
  fclose($newStyle);
}
// Define a function that deletes a directory and its contents.
function deletedir($dirname) {
         if (is_dir($dirname))
           $dir_handle = opendir($dirname);
     if (!$dir_handle)
          return false;
     while($file = readdir($dir_handle)) {
           if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                     unlink($dirname."/".$file);
                else
                     deletedir($dirname.'/'.$file);
           }
     }
     closedir($dir_handle);
     rmdir($dirname);
     return true;
}
// Grab current username
$userName = $_SESSION['userName'];
// See if someone changes a colour, write the new colour to the applicable file
if(isset($_POST['styleBGC'])) {																																										 // and the new message sent.
  styleInput('backgroundColor', $_POST['styleBGC'], $userName);
}
if(isset($_POST['styleAC'])) {																																										 // and the new message sent.
  styleInput('accentColor', $_POST['styleAC'], $userName);
}
if(isset($_POST['styleHC'])) {																																										 // and the new message sent.
  styleInput('headerColor', $_POST['styleHC'], $userName);
}
if(isset($_POST['styleMBC'])) {																																										 // and the new message sent.
  styleInput('mainBubbleColor', $_POST['styleMBC'], $userName);
}
if(isset($_POST['styleSBC'])) {																																										 // and the new message sent.
  styleInput('secondaryBubbleColor', $_POST['styleSBC'], $userName);
}
if(isset($_POST['styleMBFC'])) {																																										 // and the new message sent.
  styleInput('mainBubbleFontColor', $_POST['styleMBFC'], $userName);
}
if(isset($_POST['styleSBFC'])) {																																										 // and the new message sent.
  styleInput('secondaryBubbleFontColor', $_POST['styleSBFC'], $userName);
}

// If the user selects an option from the invites area:
// If that option is accept invite -
if(isset($_POST['accept'])) {
  // Grab the code and the user's name
  $inviteCode = $_POST['inviteCode'];
  echo $inviteCode;
  $userInviter = $userInvites["$inviteCode"];
  echo $userInviter;
  // include the inviters players in room database
  include "C:/xampp/htdocs/accountSettings/$userInviter/rooms/$inviteCode.php";
  // Check if the room exists
  if(array_key_exists($inviteCode, $rooms)=="TRUE") {
    $roomName = $rooms[$inviteCode];
    $personalRoomFile = (__DIR__."/accountSettings/$userName/roomDatabase.php");
    echo $personalRoomFile;
    arrayToFile($registeredRooms, $inviteCode, $roomName, $personalRoomFile, "registeredRooms");
    listToFile($peopleInRoom, $userName, "C:/xampp/htdocs/accountSettings/$userInviter/rooms/$inviteCode.php", "peopleInRoom");
    takeArrayFromFile($userInvites, $inviteCode, "C:/xampp/htdocs/accountSettings/$userName/invites.php", "userInvites");
    echo '<meta http-equiv="refresh" content="1;url=chat.php">';
  } else {
    echo "Something went wrong, the room doesn't exist.";
  }
}
// If that option is decline invite -
if(isset($_POST['decline'])) {
  // Grab the code and the user's name
  $inviteCode = $_POST['inviteCode'];
  $userInviter = $userInvites["$inviteCode"];
  takeArrayFromFile($userInvites, $inviteCode, "C:/xampp/htdocs/accountSettings/$userName/invites.php", "userInvites");
  echo '<meta http-equiv="refresh" content="1;url=chat.php">';
}
// Delete the user's room from the global database, their personal databases and remove it from everyone else's personal database.
if(isset($_POST['deleteRoom'])) {
  $key = $_POST['key'];
  include "C:/xampp/htdocs/accountSettings/$userName/rooms/$key.php";
  include "C:/xampp/htdocs/accountSettings/$userName/ownedRooms.php";
  // Remove room files from rooms folder and global database and the user's owned rooms database.
  deletedir("C:/xampp/htdocs/Rooms/$key");
  takeArrayFromFile($rooms, $key, "C:/xampp/htdocs/rooms.php", "rooms");
  takeArrayFromFile($ownedRooms, $key, "C:/xampp/htdocs/accountSettings/$userName/ownedRooms.php", "ownedRooms");
  // Find all users in room and take the room from their personal database
  foreach($peopleInRoom as $user) {
    include "C:/xampp/htdocs/accountSettings/$user/roomDatabase.php";
    takeArrayFromFile($registeredRooms, $key, "C:/xampp/htdocs/accountSettings/$user/roomDatabase.php", "registeredRooms");
  }
  // Delete the file that contains who is in the room you deleted
  unlink("C:/xampp/htdocs/accountSettings/$userName/rooms/$key.php");
}
// include the user's owned rooms so the name and code can be forwarded onto the invitee
include "C:/xampp/htdocs/accountSettings/$userName/ownedRooms.php";
// Send an invite to a user
if(isset($_POST['inviteUser'])) {
  $userCode = $_POST['key'];
  $inviteeName = $_POST['inviteUser'];
  include "C:/xampp/htdocs/accountSettings/$inviteeName/invites.php";
  arrayToFile($userInvites, $userCode, $userName, "C:/xampp/htdocs/accountSettings/$inviteeName/invites.php", "userInvites");
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Settings</title>
    <link rel="stylesheet" type="text/css" href='style.php'>
    <link href="../Product%20Sans/stylesheet.css" rel="stylesheet">
  </head>
  <body>
    <?php include 'headerbar.php'; include 'sidebar.php'; ?>
    <div class="mainContent" style="padding-left:25%;">
      <h3 style="text-align:center;">Before you try using hexadecimals, check out this link <a href="https://www.w3schools.com/colors/colors_picker.asp">W3Schools Colour Picker</a></h3>
      <table style="width:100%;">
        <tr>
          <th colspan="2" style="color:#0696cc;font-size:20px;">Page Styling</th>
          <th colspan="2" style="color:#0696cc;font-size:20px;">Chat Styling</th>
        </tr>
        <tr>
          <form action="Config.php" method="post">
          <th>Background Colour:</th>
          <td><input type="text" autocomplete="off" name="styleBGC" placeholder="#000000" maxlength="10" value="#"></td>
          </form>
          <form action="Config.php" method="post">
          <th>Main Bubble Colour:</th>
          <td><input type="text" autocomplete="off" name="styleMBC" placeholder="#000000" maxlength="10" value="#"></td>
          </form>
        </tr>
        <tr>
          <form action="config.php" method="post">
          <th>Accent Colour:</th>
          <td><input type="text" autocomplete="off" name="styleAC" placeholder="#000000" maxlength="10" value="#"></td>
          </form>
          <form action="config.php" method="post">
          <th>Main Font Colour:</th>
          <td><input type="text" autocomplete="off" name="styleMBFC" placeholder="#000000" maxlength="10" value="#"></td>
          </form>
        </tr>
        <tr>
          <form action="config.php" method="post">
          <th>Header Colour:</th>
          <td><input type="text" autocomplete="off" name="styleHC" placeholder="#000000" maxlength="10" value="#"></td>
          </form>
          <form action="config.php" method="post">
          <th>Secondary Bubble Colour:</th>
          <td><input type="text" autocomplete="off" name="styleSBC" placeholder="#000000" maxlength="10" value="#"></td>
          </form>
        </tr>
        <tr>
          <form action="config.php" method="post">
          <th>General Colour:</th>
          <td><input type="text" autocomplete="off" name="styleC" placeholder="#000000" maxlength="10" value="#"></td>
          </form>
          <form action="config.php" method="post">
          <th>Secondary Font Colour</th>
          <td><input type="text" autocomplete="off" name="styleSBFC" placeholder="#000000" maxlength="10" value="#"></td>
          </form>
        </tr>
        <?php
        // Only if they've received an invite, show the accept invites options.
        if(count($userInvites) > 0) {
          if(count($userInvites) == 1) {
            echo "
            <tr>
              <th colspan='4' style='color:#0696cc;font-size:20px;'>You've Received An Invite</th>
            </tr>
            ";
          } elseif(count($userInvites) > 1) {
            echo "
            <tr>
              <th colspan='4' style='color:#0696cc;font-size:20px;'>You've Received Invites</th>
            </tr>
            ";
          }
          foreach($userInvites as $key => $value) {
            // Grab the names of the rooms
            $roomName = $rooms[$key];
            echo "
            <form action='Config.php' method='post'>
            <tr>
              <th rowspan='2' colspan='2' style='color:#0696cc;font-size:20px;'>$value Has invited you to their room!<input type='hidden' value='$key' name='inviteCode'></th>
              <td colspan='2'><input type='submit' name='accept' value='Accept Invite to $roomName'></td>
            </tr>
            <tr>
              <td colspan='2'><input type='submit' name='decline' value='Decline Invite to $roomName'></td>
            </tr>
            </form>
            ";
          }
        }
        // include the user's owned pages, so they can delete it or invite people to the room. (so we can see the pages they've created)
        include "C:/xampp/htdocs/accountSettings/$userName/ownedRooms.php";
        // Only if the user owns any rooms, show the option to delete and invite users to the rooms.
        if(count($ownedRooms) > 0) {
          echo "
          <tr>
            <th colspan='4' style='color:#0696cc;font-size:20px;'>Owned Pages</th>
          </tr>
          ";
          foreach ($ownedRooms as $key => $value) {
            echo "
            <tr>
              <th rowspan='2' colspan='2' style='color:#0696cc;font-size:20px;'>$value</th>
              <td colspan='2'>
              <form action='config.php' method='post'>
              Delete Room:<input type='submit' value='Delete Room' name='deleteRoom'><input type='hidden' value='$key' name='key'>
              </form>
              </td>
            <tr>
              <td colspan='2'>
              <form action='config.php' method='post'>
              Invite a user to your room:<input type='text' name='inviteUser'><input type='submit' value='Invite User to Room'><input type='hidden' name='key' value='$key'>
              </form>
              </td>
            </tr>
            ";
          }
        }
        ?>
      </table>
    </div>
  </body>
</html>
