<?php session_start(); // Start a session where $_SESSION[] variables can be called from. ?>
<!DOCTYPE html>
<?php
$userName = $_SESSION['userName'];
$currentdir = str_replace("/Users/ethan/Sites", "", getcwd());
// Add the database to the page enable it to be used in coding
include 'feedbackDatabase.php';
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
// If feedback is submitted write it to the feedback database.
if(isset($_POST['userFeedback'])) {
  $userFeedbackName = $userName;
  $userFeedback = $_POST['userFeedback'];
  arrayToFile($feedbackArray, $userFeedbackName, $userFeedback, "feedbackDatabase.php", "feedbackArray");
}
?>
	<html>
		<head lang="en-AU">
			<link href="Product Sans/stylesheet.css" rel="stylesheet">
			<link rel="stylesheet" href="style.php">
      <?php include 'script.php'; ?>
			<meta charset="UTF-8">
			<title>Local Chat Room</title>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
		</head>
		<body>
      <?php include 'headerbar.php'; include 'sidebar.php'; ?>
      <form action="feedback.php" method="post">
        Your feedback:<input type="text" name="userFeedback" autocomplete="off"><br>
        <input type="submit" value="Submit Feedback"><br>
        Please note, spamming of feedback will lead to reduced permissions or banning.
      </form>
    </body>
