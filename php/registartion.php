<?php

session_start();

$con = mysqli_connect('localhost', 'root', ' ');

mysqli_select_db($con, 'ksec');

$name = $_POST['USER'];
$pass = $_POST['password'];


 ?>
