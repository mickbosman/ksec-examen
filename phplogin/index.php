<?php
include 'main.php';
// Als de gerbuiker al ingelogt is gaat hij naar de home pagina.
if (isset($_SESSION['loggedin'])) {
    header('Location: home.php');
    exit;
}
// Kijkt ook of de gerbuiker is herinnerd, zo ja dan gaat hij naar de home pagina
if (isset($_COOKIE['rememberme']) && !empty($_COOKIE['rememberme'])) {
	// Als de remember me cookie overeenkomt met een in de database, kunnen we de sessievariabelen bijwerken en wordt de gebruiker ingelogd.
	$stmt = $pdo->prepare('SELECT * FROM accounts WHERE rememberme = ?');
	$stmt->execute([ $_COOKIE['rememberme'] ]);
	$account = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($account) {
		// De match is gevonden, de gerbuiker is "rememberd" de gerbuiker word nu automatisch ingelogd.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $account['username'];
		$_SESSION['id'] = $account['id'];
        $_SESSION['role'] = $account['role'];
        header('Location: home.php');
		exit;
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Login</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
		<div class="login">
			<h1>Login</h1>
			<div class="links">
				<a href="index.php" class="active">Login</a>
				<a href="register.html">Register</a>
			</div>
			<form action="authenticate.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<label id="rememberme">
					<input type="checkbox" name="rememberme">Remember me
				</label>
				<div class="msg"></div>
				<input type="submit" value="Login">
			</form>
		</div>
		<script>
        document.querySelector(".login form").onsubmit = function(event) {
			event.preventDefault();
			var form_data = new FormData(document.querySelector(".login form"));
			var xhr = new XMLHttpRequest();
			xhr.open("POST", document.querySelector(".login form").action, true);
			xhr.onload = function () {
				if (this.responseText.toLowerCase().indexOf("success") !== -1) {
					window.location.href = "home.php";
        } else if (this.responseText.indexOf("2FA") !== -1) {
  window.location.href = this.responseText.replace("2FA: ", "");
				} else {
					document.querySelector(".msg").innerHTML = this.responseText;
				}
			};
			xhr.send(form_data);
		};
		</script>
	</body>
</html>
