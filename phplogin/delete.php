<?php

include 'main.php';
include 'config.php';
include 'db.php';
include 'admin/includes.php'; // gebruikt het connectie bestand

$id = $_GET['id']; // pakt id door een query string

$del = mysqli_query($db,"delete from videos where id = '$id'"); // verwijderd query

if($del)
{
  $log = "User deleted video id: $id";
  logger($log);

    mysqli_close($db); // Sluit connectie
    header("location:admin/settings.php"); // Verwijst door naar de setting pagina
    exit;
}
else
{
    echo "Error deleting record"; // laat error bericht zien als hij niet verwijderd
}
?>
