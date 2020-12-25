<?php

include_once('../header.php')

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="utf-8">
    <title>VideoBox</title>
  </head>
  <body>


  <div class="container" id="container-border">
    <div class="row">
      <div class="col-md-6" id="login-border">
        <p class="login-text">Forgot your password?</p>
        <div class="col-md-6" id="wachtwoord-border">
        <p class="wachtwoord-text">Don't worry, just enter your email and we will send a new password to your email!</p></div>
        <form action="validation.php" method="post">
          <div class="form-group" id="form-group-10">
            <label>Email</label>
            <input type="text" name="user" class="form-control" id="form-control" required>
          </div>
          <button type="submit" name="button" class="btn-primary-1">Submit</button>
        </form>

      </div>

    </div>

  </div>


  <footer>
      <div class="footer_wrapper">
        <nav class="footer-nav">
          <a href="#">Pagina</a>
          <a href="#">Pagina</a>
          <a href="#">Pagina</a>
          <a href="#">Pagina</a>
          <a href="#">Pagina</a>
          <a href="#">Pagina</a>
          <a href="#">Pagina</a>
        </nav>
      </div>
    </footer>


  </body>
</html>
