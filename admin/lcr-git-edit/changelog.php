<?php session_start(); // Start a session where $_SESSION[] variables can be called from. ?>
<!DOCTYPE html>
<?php
$userName = $_SESSION['userName'];
$currentdir = str_replace("C:/xampp/htdocs", "", getcwd());
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
      <div>
        <h3>Changelog</h3>
        <h2>A (fairly) Big Update</h2>
        <ul>
          <li>- Bug fix, uploading images wasn't working. Does now: 23/8/19, 12:53 pm</li>
          <li>- Bug fix, made custom rooms work again: 23/8/19, 12:29 am</li>
          <li>- Bug fix, declining invites for rooms that have already been deleted works properly: 23/8/19, 8:15 am</li>
          <li>- You now get an icon to indicate received invites next to the settings button in the sidebar: 23/8/19, 8:01 am</li>
          <li>- Deleting rooms works, all users in said rooms also get it removed from their sidebars: 23/8/19, 7:47 am</li>
          <li>- You can now accept and decline invites from other users to their pages: 22/8/19, 8:37 pm</li>
          <li>- You can now invite users to your custom rooms from the settings page: 22/8/19, 8:37 pm</li>
        </ul>
        <h2>The Beginning of the Changelog</h2>
        <ul>
          <li>- Added a manage pages section where users can accept invites to pages or manage the pages they create: 22/8/19, 7:01 pm</li>
          <li>- Changed the chat bar so it behaves better with devices with different resolutions: 22/8/19, 12:13 am</li>
          <li>- If you don't log in, the chat bar (where you enter messages) doesn't appear: 22/8/19, 11:14 am</li>
          <li>- Made it so that moderators weren't seeing the devpage in the sidebar when in a custom room: 22/8/19, 11:03 am</li>
          <li>- Updated privacy policy, also added the terms of service so I don't get in too much trouble: 22/8/19, 10:52 am</li>
          <li>- Got rid of more 'eee's: 22/8/19, 10:42 am</li>
          <li>- Fixed adding custom rooms to sidebar: 22/8/19, 10:41 am</li>
          <li>- Got rid of the curse of the "eeeee"s: 22/8/19, 10:05 am</li>
          <li>- Added functionality to the feedback page and set up a system so that developers can see the feedback, too: 22/8/19, 9:55 am</li>
          <li>- Bug fixed the custom room page, works now: 22/8/19, 9:37 am</li>
          <li>- Created a feedback page: 22/8/19, 9:13 am</li>
          <li>- Created a changelog: 22/8/19, 8:57 am</li>
        </ul>
      </div>
    </body>
