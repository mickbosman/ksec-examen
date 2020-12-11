<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="utf-8">
    <title>VideoBox</title>
  </head>
  <body>
    <div class="topnav">
 <a href="main.php">Home</a>
 <a href="#news">News</a>
 <a href="#contact">Contact</a>
 <a href="#about">About</a>
 <a class="active" href="#login">Login</a>
 <a href="signup.php">Sign up</a>
</div>


  <div class="container" id="container-border">
    <div class="row">
      <div class="col-md-6" id="login-border">
        <p class="login-text">Welcome to … please login to your account</p>
        <form action="validation.php" method="post">
          <div class="form-group" id="form-group-1">
            <label>Username</label>
            <input type="text" name="user" class="form-control" id="form-control" required>
          </div>
          <div class="form-group" id="form-group-2">
            <label>Password</label>
            <input type="password" name="password" class="form-control" id="form-control" required>
          </div>
          <button type="submit" name="button" class="btn-primary">Login</button>
        </form>

      </div>

    </div>

  </div>


  </body>
</html>
