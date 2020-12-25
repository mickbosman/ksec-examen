<?php

include_once('header.php')

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
      <p class="login-text">Welcome to … please login to your account</p>
      <form action="registration.php" method="post">
        <div class="form-group" id="form-group-3">
          <label>Username</label>
          <input type="text" name="user" class="form-control" id="form-control" required>
        </div>
         <div class="form-group" id="form-group-4">
         <label>Email</label>
          <input type="text" name="email" class="form-control" id="form-control" required>
        </div>
        <div class="form-group" id="form-group-4">
         <label>Email</label>
          <input type="text" name="email" class="form-control" id="form-control" required>
        </div>
        <div class="form-group" id="form-group-4">
          <label>Password</label>
          <input type="password" name="password" class="form-control" id="form-control" required>
        </div>
        <div class="form-group" id="form-group-4">
          <label>Password</label>
          <input type="password" name="cPassword" class="form-control" id="form-control" required>
        </div>


        <button type="submit" name="button" class="btn-primary">Sign Up</button>
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