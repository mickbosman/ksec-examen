<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="utf-8">
    <title>VideoBox</title>
  </head>
  <body>
    <div class="topnav">
 <a href="#home">Home</a>
 <a href="#news">News</a>
 <a href="#contact">Contact</a>
 <a href="#about">About</a>
 <a class="active" href="#login">Login</a>
 <a href="#signup">Sign up</a>
</div>


  <div class="container" id="container-border">
    <div class="row">
      <div class="col-md-6" id="login-border">
        <h2 class="login-text">Login</h2>
        <form action="validation.php" method="post">
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="user" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="text" name="user" class="form-control" required>
          </div>
          <button type="submit" name="button" class="btn btn-primary">Login</button>
        </form>

      </div>

    </div>

  </div>


  </body>
</html>
