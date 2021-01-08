<?php

include_once('../header.php')

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>VideoBox</title>
  </head>
  <body>



<?php

include ('db.php');

$sql = "select * from videos";
$res = mysqli_query($con,$sql);

echo "<h1> MYVIDEOS </h1>";

while ($row = mysqli_fetch_assoc($res)) {


      $id = $row['id'];
      $name= $row['name'];
      $description= $row['description'];
?>
<div class="videobox">

<video width="400px" controls>
  <source src="videos/<?php echo $name; ?>" type="video/mp4">
</video>
<p>Name: <?php echo $row['name']; ?></p>
<p>Description: <?php echo $row['description']; ?></p>
</div>

<?php

}


 ?>


    </body>
  </html>
