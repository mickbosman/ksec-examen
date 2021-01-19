<?php
include 'admin/includes.php';
include 'main.php';
check_loggedin($pdo);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,minimum-scale=1">
  <title>Home Page</title>
  <link href="style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body class="loggedin">
  <nav class="navtop">
    <div>
      <h1>Website Title</h1>
      <a href="home.php"><i class="fas fa-home"></i>Home</a>
      <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
      <?php if ($_SESSION['role'] == 'Admin'): ?>
      <a href="admin/index.php" target="_blank"><i class="fas fa-user-cog"></i>Admin</a>
      <?php endif; ?>
      <?php if ($_SESSION['role'] == "Admin"): ?>
      <a href="uploader.php" target="_blank"><i class="fas fa-user-cog"></i>Uploader</a>
      <?php endif; ?>
      <?php if ($_SESSION['role'] == "Member"): ?>
      <a href="uploader.php" target="_blank"><i class="fas fa-user-cog"></i>Uploader</a>
      <?php endif; ?>
      <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
  </nav>
<div class="borderuploader">

<form method="post" action="uploader.php" enctype="multipart/form-data"></from>

<input type="file" name="file">
<div class="form-group" id="form-group-1">
  <label>Title</label>
  <input type="text" name="title" class="form-control" id="form-control" required>
</div>
<div class="form-group" id="form-group-2">
  <label>Description</label>
  <input type="text" name="description" class="form-control" id="form-control" required>
</div>
<input type="submit" name="upload" value="UPLOAD">

</from>
</div>
  </body>
</html>

<?php
include ('db.php');

if (isset($_POST['upload'])) {
  $log = "User uploaded a file";
  logger($log);

  $tmp = $_FILES['file']['tmp_name'];
  $description = $_POST['description'];
  $title = $_POST['title'];
  $name = $_FILES['file']['name'];


  move_uploaded_file($tmp, "videos/".$name);

  $sql = "INSERT INTO videos (name, title, description) VALUES('$name','$title', '$description')";

  $res = mysqli_query($db,$sql);

  if ($res ==1) {
    echo "<h1>video inserted successfully</h1>";
  }
}

 ?>
