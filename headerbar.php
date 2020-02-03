<?php
if(!isset($_SESSION['userName'])) {
    $userName = "";
}

?>
<nav>
  <ul>
    <li><a href='privacy.php'>Privacy</a></li>
    <li><a href='register.php'>Register</a></li>
      <?php
      if(!isset($_SESSION['userName'])) {
      echo "<li id='loginForm'><a>
      <form action='encrypt.php' method='post'>
      <input type='text' name='loginUsername' placeholder='Username:'>
      <input type='password' name='loginPassword' placeholder='Password:'>
      <input type='submit'>
      </form>
      </a></li>";
      } else {
        echo "<li><a><form  action='encrypt.php' method='post'><input name='logout' type='submit' value='logout'></form></a></li>";
      }
    ?>
    <li><a><?php echo $userName; ?><br></a></li>
    <li style='padding:0;padding-left:10vw;float:left;'><a style='color:#0696cc;'href='/linus.php'><h1>ACSHSISC</h1></a></li>
  </ul>
</nav>
