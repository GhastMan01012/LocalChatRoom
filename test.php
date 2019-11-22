<head>
  <style media="screen">
  #loginForm {
    display: none;
  }
  #loginItem ~ #loginForm {
    display: list-item;
  }
  </style>
</head>
<nav>
  <ul>
    <li id='loginForm'><a>
      <form action='encrypt.php' method='post'>
        <input type="text" name="loginUsername" placeholder="Username:">
        <input type="text" name="loginPassword" placeholder="Password:">
      </form>
    </a></li>
    <li id='loginItem'><a>Login</a></li>
    <li><a href='register.php'>Register</a></li>
    <li><a>Privacy</a></li>
  </ul>
</nav>
