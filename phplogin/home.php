<?php
include 'main.php';
check_loggedin($pdo);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Website Title</h1>
				<a href="home.php"><i class="fas fa-home"></i>Home</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<?php if ($_SESSION['role'] == 'Admin'): ?>
				<a href="admin/index.php" target="_blank"><i class="fas fa-user-cog"></i>Admin</a>
				<?php endif; ?>
				<?php if ($_SESSION['role'] == "Admin"): ?>
	      <a href="uploader.php" target="_blank"><i class="fas fa-file-upload"></i>Uploader</a>
	      <?php endif; ?>
	      <?php if ($_SESSION['role'] == "Member"): ?>
	      <a href="uploader.php" target="_blank"><i class="fas fa-file-upload"></i>Uploader</a>
	      <?php endif; ?>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
			<p class="block">Welcome back, <?=$_SESSION['name']?>!</p>
			<?php


			include ('db.php');
			include_once 'config.php';

			$sql = "select * from videos";
			$res = mysqli_query($db,$sql);

			while ($row = mysqli_fetch_assoc($res)) {


				$id = $row['id'];
				$name= $row['name'];
				$description= $row['description'];
			?>
			<div class="videobox">

				<center>
			<video width="600px" height="300px" controls>
			<source src="videos/<?php echo $name; ?>" type="video/mp4">
			</video>
		</center>
			<p><?=$_SESSION['name']?></p>
			<p>Title: <?php echo $row['title']; ?></p>
			<p>Description: <?php echo $row['description']; ?></p>

			</div>

			<style media="screen">
			.videobox{
			color: white;
			background-color: #2f3947;
			width: 100%;
			}
			video{
				border: 1px solid black;
				background-color: black;
			}
			</style>

			<?php

			}


			?>
		</div>



	</body>
</html>
