<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="style.css">
  <title>Login</title>
</head>
<body>

  <div class="top-bar">
    <a href="index.php?page=home" class="home-button">Go to Home Feed</a>
  </div>

  <div class="container">
      <h2>Login</h2>
      <form method="POST" action="index.php?page=login">
          <input type="text" name="username" placeholder="Username" required>
          <input type="password" name="password" placeholder="Password" required>
          <button type="submit" name="login_submit">Login</button>
      </form>
      <a href="index.php?page=register" class="signup-link">Sign Up</a>
  </div>

</body>
</html>
