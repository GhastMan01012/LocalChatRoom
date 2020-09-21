<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset='utf-8' lang='en-AU'>
    <title>EComCo</title>
    <?php include 'globalLinks.php'; ?>
</head>
<body>
    <?php include 'headerbar.php'; ?>
    <div class='container-fluid'>
        <div class='row'>
            <h3 class='mx-auto mt-4'>Login</h3>
        </div>
        <div class='row'>
            <form class='mx-auto mt-3 p-3' style='width:fit-content;height:fit-content;background-color:#fff;' action='index.php' method='post'>
                Email:<br> <input type='text' name='email' placeholder='Email' required><br>
                Password:<br> <input type='password' name='password' placeholder='Password' required><br>
                <input class='mt-2' type='submit'>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
<?php
// Registered Account Processing
if(isset($_POST['email'])) {
    $userEmail = $_POST['email'];
    $userPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    $servername = "localhost";
	$username = "root";
	$password = "root";

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
    }

    // Check if user account already exists
    $sql = 'SELECT `Email` FROM users.users WHERE Email = "'.$userEmail.'";';
    $result = $conn->query($sql);
    if($result->num_rows == 0) {
        $sql2 = "INSERT INTO users.users (`Email`, `Password`, `FirstName`, `LastName`) VALUES ('".$userEmail."', '".$userPassword."', '".$firstName."', '".$lastName."');";
        $result2 = $conn->query($sql2);

        echo "<h6 class='mx-auto mt-2' style='width:fit-content;'>Successfully registered, now login</h6>";
    } else {
        echo "<h6 class='mx-auto mt-2' style='width:fit-content;'>This email has been used already</h6>";
    }
}
?>