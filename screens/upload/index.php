<?php

include_once('../header-2.php')

 ?>

<!DOCTYPE html>
<html>
  <head>
    <title>video upload</title>
    <link rel="stylesheet" href="../../css/style-2.css">
  </head>
  <body>
<h1> <a href="video.php">VIDEOS</a></h1>

<form method="post" action="index.php" enctype="multipart/form-data"></from>

<input type="file" name="file">
<div class="form-group" id="form-group-1">
  <label>Description</label>
  <input type="text" name="description" class="form-control" id="form-control" required>
</div>
<input type="submit" name="upload" value="UPLOAD">

</from>

  </body>
</html>

<?php
include ('db.php');

if (isset($_POST['upload'])) {

  $description = $_POST['description'];
  $name = $_FILES['file']['name'];
  $tmp = $_FILES['file']['tmp_name'];


  move_uploaded_file($tmp, "videos/".$name);

  $sql = "INSERT INTO videos (name, description) VALUES('$name', '$description')";

  $res = mysqli_query($con,$sql);

  if ($res ==1) {
    echo "<h1>video inserted successfully</h1>";
  }
}

 ?>
