<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="../../css/style.css">
    <meta charset="utf-8">
    <title>VideoBox</title>
  </head>
  <body>
    <div class="topnav">
 <a class="active" href="#home">Home</a>
 <a href="#news">News</a>
 <a href="#contact">Contact</a>
 <a href="#about">About</a>
 <a href="login.php">Login</a>
 <a href="signup.php">Sign up</a>
</div>



<?php

include ('db.php');

$sql = "select * from videos";
$res = mysqli_query($con,$sql);

echo "<h1> MYVIDEOS </h1>";

while ($row = mysqli_fetch_assoc($res)) {


      $id = $row['id'];
      $name= $row['name'];

?>

<video width="615" height="315" controls>
  <source src="videos/<?php echo $name; ?>" type="video/mp4">

</video>

<?php

}


 ?>


 

    </body>
  </html>
