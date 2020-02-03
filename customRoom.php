<?php session_start(); // Start a session where $_SESSION[] variables can be called from.
if(isset($_SESSION['userName'])) {
    $userName = $_SESSION['userName'];
}
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
  </head>
  <body>
    <?php include 'headerbar.php'; include 'sidebar.php'; ?>
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
        mkdir("C:/xampp/htdocs/Rooms/$roomCode");
        copydir("C:/xampp/htdocs/Template", "C:/xampp/htdocs/Rooms/$roomCode");
      }
      ?>
    </div>
  </body>
</html>
