<?php session_start(); // Start a session where $_SESSION[] variables can be called from. ?>
<!DOCTYPE html>
<?php
$userName = $_SESSION['userName'];
// Include the feedback database, so the developers can see user feedback
include 'feedbackDatabase.php';
?>
<html>
	<head lang="en-AU">
		<link href="../Product%20Sans/stylesheet.css" rel="stylesheet">
		<link rel="stylesheet" href="style.php">
    <?php include 'script.php'; ?>
		<meta charset="UTF-8">
		<title>Local Chat Room</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	</head>
	<body>
		<?php include 'headerbar.php'; include 'sidebar.php'; ?>
		<div style="margin-left:25.8vw;">
			<h2>List of stuff the developer(s) are working on -</h2>
			<ul>
				<li>Display users that are online</li>
				<li>Improve login system, somehow</li>
				<li>Redesign User Settings (including the infrastructure for it)</li>
				<li>Add a level system (Apparently) maybe reputation.</li>
				<li>Make the colour changing easier to understand.</li>
				<li>Make profiles or something</li>
				<li>Add the ability to report users</li>
				<li>Make it so moderators can see reports on their page</li>
				<li>Improve experience for those on iPads</li>
				<li>Give users ownership over the pages they make</li>
			</ul>
			<h2>User Feedback -</h2>
			<ul>
				<?php
				foreach ($feedbackArray as $key => $value) {
					echo "<li>$key: $value</li>";
				}
				?>
			</ul>
		</div>
	</body>
</html>
