<?php

include_once('header.php')

 ?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="../css/style.css">
    <title>video upload</title>
  </head>
  <body>
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
include ('../db.php');

if (isset($_POST['upload'])) {

  $tmp = $_FILES['file']['tmp_name'];
  $description = $_POST['description'];
  $title = $_POST['title'];
  $name = $_FILES['file']['name'];


  move_uploaded_file($tmp, "../uploaded-videos/".$name);

  $sql = "INSERT INTO videos (name, title, description) VALUES('$name','$title', '$description')";

  $res = mysqli_query($conn,$sql);

  if ($res ==1) {
    echo "<h1>video inserted successfully</h1>";
  }
}

 ?>
