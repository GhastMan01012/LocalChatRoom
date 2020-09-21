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
            <h3 class='mx-auto mt-4'>Register An Account</h3>
        </div>
        <div class='row'>
            <form class='mx-auto mt-3 p-3' style='width:fit-content;height:fit-content;background-color:#fff;' action='login.php' method='post'>
                First Name:<br> <input type='text' name='firstName' placeholder='First Name'><br>
                Last Name:<br> <input type='text' name='lastName' placeholder='Last Name'><br>
                Email:<br> <input type='text' name='email' placeholder='Email'><br>
                Password:<br> <input type='password' name='password' placeholder='Password'><br>
                <input class='mt-2' type='submit'>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>