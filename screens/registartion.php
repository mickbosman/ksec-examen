<?php

session_start();
header('location:login.php');

$con = mysqli_connect('localhost', 'root', '');

mysqli_select_db($con, 'ksec');

$name = $_POST['user'];
$pass = $_POST['password'];
$email = $_POST['email'];

$hashedpass = password_hash($pass, PASSWORD_DEFAULT);

$s = " select * from usertable where name = '$name'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
  echo "Username already taken";
} else {
  $reg= "insert into usertable(name, password, email) values ('$name', '$pass', '$email')";
  mysqli_query($con, $reg);
  echo "Registration successful";
}

 ?>
