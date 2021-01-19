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
  <tr>
    <video width="400px" height="225px" controls>
		  <source src="../videos/<?php echo $data['name']; ?>" type="video/mp4">
		</video>
    <td><?php echo $data['id']; ?></td>
    <td><?php echo $data['name']; ?></td>
    <td><?php echo $data['title']; ?></td>
    <td><?php echo $data['description']; ?></td>
    <td><a href="../edit.php?id=<?php echo $data['id']; ?>">Edit</a></td>
    <td><a href="../delete.php?id=<?php echo $data['id']; ?>">Delete</a></td>
  </tr>
  </div>
<?php
}
?>
</table>
</body>
</html>
<?=template_admin_footer()?>
