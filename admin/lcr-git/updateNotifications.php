<?php session_start();
$userName = $_SESSION['userName'];
include '/Users/ethan/Sites/chat/latestMessage.php';
// Define a function to write variables to and from files.
function varToFile($newValue, $filePath, $varName) {
	$varFile = fopen($filePath, "w");
	fwrite($varFile, "<?php $$varName = $newValue; ?>");
	fclose($varFile);
}
// Use the function
varToFile($latestMessageSent, "/Users/ethan/Sites/chat/accountSettings/$userName/messageViewed.php", "lastMessageViewed");
?>
