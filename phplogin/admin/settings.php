<?php
include 'main.php';
?>
<?=template_admin_header('Settings')?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

<h2>Settings</h2>

<?php

include "../db.php"; // Using database connection file here

$records = mysqli_query($db,"select * from videos"); // fetch data from database

while($data = mysqli_fetch_array($records))
{
?>
<div class="">
  <div class="videobox">
  <tr>
    <video width="400px" height="225px" controls>
		  <source src="../videos/<?php echo $data['name']; ?>" type="video/mp4">
		</video>
    <td>ID=<?php echo $data['id']; ?></td>
    <td><br></td>
    <td><br></td>
    <td>Name=<?php echo $data['name']; ?></td>
    <td><br></td>
    <td><br></td>
    <td>Title=<?php echo $data['title']; ?></td>
    <td><br></td>
    <td><br></td>
    <td>Description=<?php echo $data['description']; ?></td>
    <td><br></td>
    <td><br></td>
    <td><a href="../edit.php?id=<?php echo $data['id']; ?>">Edit</a></td>
    <td><a href="../delete.php?id=<?php echo $data['id']; ?>">Delete</a></td>
  </tr>
  </div>
</div>

<style media="screen">
.videobox{
color: white;
background-color: #484848;
width: 400px;
height: 450px;
margin-bottom: 10px;
}


video{
  border: 1px solid black;
  background-color: black;
}
</style>
<?php
}
?>
</table>
</body>
</html>
<?=template_admin_footer()?>
