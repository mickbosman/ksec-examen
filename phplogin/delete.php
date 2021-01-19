<?php

include 'main.php';
include 'config.php';
include 'db.php';
include 'admin/includes.php'; // Using database connection file here

$id = $_GET['id']; // get id through query string

$del = mysqli_query($db,"delete from videos where id = '$id'"); // delete query

if($del)
{
  $log = "User deleted video id: $id";
  logger($log);

    mysqli_close($db); // Close connection
    header("location:admin/settings.php"); // redirects to all records page
    exit;
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>
