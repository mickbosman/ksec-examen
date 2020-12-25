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

?>

<video width="300" height="200" controls>
  <source src="videos/<?php echo $name; ?>" type="video/mp4">

</video>

<?php

}


 ?>


    </body>
  </html>
