<?php

session_start();

$con = mysqli_connect('localhost', 'root', '');

mysqli_select_db($con, 'ksec');

$name = $_POST['user'];
$pass = $_POST['password'];

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
  $_SESSION['username'] = $name;
  header('location:upload/video.php');
} else {

}

 ?>
