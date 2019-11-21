<?php session_start();// Start a session where $_SESSION[] variables can be called from.

// Define a function to add all the default values to the UserSettings.Colours table
function defaultify($userName) {
  $link = mysqli_connect("localhost", "root", "root", "UserSettings");
  $sql = "INSERT INTO Colours (UserName, MainBubble, MainBubbleFont, SecondaryBubble, SecondaryBubbleFont, BackgroundColour, AccentColour, HeaderColour, GeneralColour) VALUES ('".$userName."', '#d51c46', '#ffffff', '#dfdfdf', '#116280', '#dfdfdf', '#d51c46', '#116280', '#0696cc')";
    if(!mysqli_query($link, $sql)) {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    } else {
        echo "<meta http-equiv='refresh' content='3;url:Chat.php'>";
    }
  // Close connection
  mysqli_close($link);
}

// Encrypt the set password and write it to the file. (When the client registers and account)
if(isset($_POST['registerPassword'])) {
  $encrypted = password_hash($_POST['registerPassword'], PASSWORD_BCRYPT);
  $userName = $_POST['registerUsername'];
  // Attempt MySQL server connection.
  $link = mysqli_connect("localhost", "root", "root", "LCR");
  // Check connection
  if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  $mysql_get_users = mysqli_query($link, "SELECT * FROM UserAccounts WHERE UserName = '$userName'");
  $get_rows = mysqli_affected_rows($link);
  if($get_rows >=1){
    echo "This username is taken. <meta http-equiv='refresh' content='3;url:register.php'>";
    die();
  } else {
    // Attempt insert query execution
    $sql = "INSERT INTO UserAccounts (Perms, UserName, UserKey) VALUES (2, '$userName', '$encrypted')";
    if(!mysqli_query($link, $sql)) {
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    echo "<meta http-equiv='refresh' content='3;url:Chat.php'>";
    // Create default colours for everyone
    defaultify($userName);
  }
  // Close connection
  mysqli_close($link);
};
// When a client logs in, put their username into a session variable and other useful spots.
if(isset($_POST['loginUsername'])) {
  // Store their username in a variable
  $userName = $_POST['loginUsername'];

  // Setup a database connection
  $link = mysqli_connect("localhost", "root", "root", "LCR");

  // Check if the password given is correct
  $sql = "SELECT UserKey FROM LCR.UserAccounts WHERE UserName = '$userName'";
  $passwordHash = mysqli_fetch_assoc(mysqli_query($link, $sql))['UserKey'];
  if(password_verify($_POST['loginPassword'], $passwordHash)) {
    // Connect to the database and grab user perms and name by matching the username and password
    $sql = "SELECT Perms, UserName FROM LCR.UserAccounts WHERE UserKey = '".$passwordHash."' AND UserName = '$userName'";
    if(!mysqli_query($link, $sql)) {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    } else {
        echo "<meta http-equiv='refresh' content='3;url:Chat.php'>";
    }
    $results = mysqli_query($link, $sql);
    // Turn the data into an array where each key is a column in the table
    $data = mysqli_fetch_assoc($results);
    // Write the database info to a session variable so it can be called later
    echo $data['UserName'];
    $_SESSION['userName'] = $data['UserName'];
    $_SESSION['permissions'] = $data['Perms'];
  } else {
    echo "FALSE";
  }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Redirecting...</title>
  </head>
  <body>
    You are being redirected automatically back to the main page... (although, if it didn't work ^^^^^)
  </body>
</html>
