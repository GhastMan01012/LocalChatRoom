<?php session_start(); // Start a session where $_SESSION[] variables can be called from.
$userName = $_SESSION['userName'];
// Define a function to generate a random string (unsecure).
function randstring($charlen) {
  $characters = "abcdefghijklmnopqrstuvwxyz";
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $charlen; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  };
  return $randomString;
};
// Define a function to clear Ascii hex codes from url encoding. (http_build_query)
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
// Define a function to write an dictionary to a file.
function arrayToFile($oldList, $key, $value, $fileName, $name) {
  $oldList["$key"] = $value;
  $newList = http_build_query($oldList, '', ', ');
  $newList = noAscii($newList);
  $newList = str_replace("=", "=>", "$newList");
  $newList = '"'.$newList;
  $newList = str_replace("=>", '"=>"', $newList);
  $newList = str_replace(", ", '", "', $newList);
  $arrayFile = fopen("$fileName", "w");
  fwrite($arrayFile, "<?php ".'$'.$name.' = array('.$newList.'"); ?>');
  fclose($arrayFile);
};
// Define a function to write an list to a file.
function listToFile($oldList, $value, $fileName, $name) {
  $oldList[] = $value;
  $newList = implode('", "', $oldList);
  $arrayFile = fopen("$fileName", "w");
  fwrite($arrayFile, "<?php ".'$'.$name.' = array("'.$newList.'"); ?>');
  fclose($arrayFile);
};
// Define a function that copies a directories files to another
function copydir($src, $dst) {
    // open the source directory
    $dir = opendir($src);
    // Make the destination directory if not exist
    @mkdir($dst);
    // Loop through the files in source directory
    foreach (scandir($src) as $file) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) )
            {
                // Recursively calling custom copy function
                // for sub directory
                copydir($src . '/' . $file, $dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Make a Room</title>
    <link rel="stylesheet" type="text/css" href="style.php">
    <link href="../Product%20Sans/stylesheet.css" rel="stylesheet">
  </head>
  <body>
    <?php include 'headerbar.php'; include 'sidebar.php'; include "/Users/ethan/Sites/chat/accountSettings/$userName/roomDatabase.php"; include 'rooms.php'; include "/Users/ethan/Sites/chat/accountSettings/$userName/ownedRooms.php"; ?>
    <h2>Create A Room</h2>
    <div>
      <form action="customRoom.php" method="post">
        Create a custom room:<br>
        Give your room a name - <input type="text" name="roomName" placeholder="Sick Room Name"><input type="submit" value="Create Room">
      </form>
      <?php
      // Create the room, add it to the global database and to the user's room database.
      if(isset($_POST['roomName'])) {
        // Let the user know that the user's page exists.
        echo "Your room has been added to the sidebar.";
        // Make coding easier, give roomName and nicer variable name.
        $roomName = $_POST['roomName'];
        // Generate a random 5 character code that isn't the same as any of the others. (To prevent duplicates)
        $roomCode = randstring(5);
        while(array_key_exists($roomCode, $rooms)=="TRUE") {
          $roomCode = randstring(5);
        }
        // Make the files required to have a functioning page.
        mkdir("/Users/ethan/Sites/Chat/Rooms/$roomCode");
        copydir("/Users/ethan/Sites/chat/Template", "/Users/ethan/Sites/chat/Rooms/$roomCode");
        // Add the new room to the global database.
        arrayToFile($rooms, $roomCode, $roomName, "rooms.php", "rooms");
        // Add the new room to the users registered rooms database.
        arrayToFile($registeredRooms, $roomCode, $roomName, "/Users/ethan/Sites/chat/accountSettings/$userName/roomDatabase.php", "registeredRooms");
        // Add the rooms to the user's owned rooms database (so we can see that its theirs and thus give them permission to do stuff to it)
        arrayToFile($ownedRooms, $roomCode, $roomName, "/Users/ethan/Sites/chat/accountSettings/$userName/ownedRooms.php", "ownedRooms");
        // Create a new database to contain the names of users that have been added to the users.
        $peopleInRoomFile = fopen("/Users/ethan/Sites/chat/accountSettings/$userName/rooms/$roomCode.php", "c+");
        fwrite($peopleInRoomFile, '<?php $peopleInRoom = array(); ?>');
        fclose($peopleInRoomFile);
        // Add themselves to the database
        include "/Users/ethan/Sites/chat/accountSettings/$userName/rooms/$roomCode.php";
        listToFile($peopleInRoom, $userName, "/Users/ethan/Sites/chat/accountSettings/$userName/rooms/$roomCode.php", "peopleInRoom");
      }
      ?>
    </div>
  </body>
</html>
