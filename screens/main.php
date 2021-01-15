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



<?php

include ('../db.php');

$sql = "select * from videos";
$res = mysqli_query($conn,$sql);


while ($row = mysqli_fetch_assoc($res)) {


      $id = $row['id'];
      $name= $row['name'];
      $description= $row['description'];
?>
<div class="videobox">

<video width="400px" height="225px" controls>
  <source src="../uploaded-videos/<?php echo $name; ?>" type="video/mp4">
</video>
<p>Title: <?php echo $row['title']; ?></p>
<p>Description: <?php echo $row['description']; ?></p>
</div>

<?php

}


 ?>

    </body>
  </html>
