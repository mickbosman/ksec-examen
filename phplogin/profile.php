<?php
include 'main.php';
check_loggedin($pdo);
// laat bericht zien (errors, etc)
$msg = '';
// We hebben het wachtwoord of de e-mail niet opgeslagen in sessies, dus in plaats daarvan kunnen we de resultaten uit de database halen.
$stmt = $pdo->prepare('SELECT * FROM accounts WHERE id = ?');
// In dit geval kunnen we de account-ID gebruiken om de accountinformatie te krijgen.
$stmt->execute([ $_SESSION['id'] ]);
$account = $stmt->fetch(PDO::FETCH_ASSOC);
// dit Behandeld postgegevens om het profiel te bewerken
if (isset($_POST['username'], $_POST['password'], $_POST['cpassword'], $_POST['email'])) {
	// Zorgt ervoor dat de ingediende registratiewaarden niet leeg zijn.
	if (empty($_POST['username']) || empty($_POST['email'])) {
		$msg = 'The input fields must not be empty!';
	} else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$msg = 'Please provide a valid email address!';
	} else if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['username'])) {
	    $msg = 'Username must contain only letters and numbers!';
	} else if (!empty($_POST['password']) && (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5)) {
		$msg = 'Password must be between 5 and 20 characters long!';
	} else if ($_POST['cpassword'] != $_POST['password']) {
		$msg = 'Passwords do not match!';
	}
	if (empty($msg)) {
		// Controleerd of er al een nieuwe gebruikersnaam of e-mailadres in de database bestaat
		$stmt = $pdo->prepare('SELECT COUNT(*) FROM accounts WHERE (username = ? OR email = ?) AND username != ? AND email != ?');
		$stmt->execute([ $_POST['username'], $_POST['email'], $_SESSION['name'], $account['email'] ]);
		if ($result = $stmt->fetchColumn()) {
			$msg = 'Account already exists with that username and/or email!';
		} else {
			// er zijn geen errors opgetreden, het accout word geupdate.
			$uniqid = account_activation && $account['email'] != $_POST['email'] ? uniqid() : $account['activation_code'];
			$stmt = $pdo->prepare('UPDATE accounts SET username = ?, password = ?, email = ?, activation_code = ? WHERE id = ?');
			// het wachtwoord word gehashed in de database en gebruikt password_verify wanneer een gebruiker inlogt.
			$password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $account['password'];
			$stmt->execute([ $_POST['username'], $password, $_POST['email'], $uniqid, $_SESSION['id'] ]);
			// Werkt de sessievariabelen bij
			$_SESSION['name'] = $_POST['username'];
			if (account_activation && $account['email'] != $_POST['email']) {
				// Accountactivering is vereist, dus dit stuurt de gebruiker de activerings e-mail met de functie "send_activation_email" vanuit het bestand "main.php"
				send_activation_email($_POST['email'], $uniqid);
				// logt de gebruiker uit
				unset($_SESSION['loggedin']);
				$msg = 'You have changed your email address, you need to re-activate your account!';
			} else {
				// het profiel word bijgewerkt en leidt de gebruiker terug naar de profielpagina en niet naar profielpagina bewerken
				header('Location: profile.php');
				exit;
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Profile Page</title>
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
	      <a href="uploader.php" target="_blank"><i class="fas ffa-file-upload"></i>Uploader</a>
	      <?php endif; ?>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<?php if (!isset($_GET['action'])): ?>
		<div class="content profile">
			<h2>Profile Page</h2>
			<div class="block">
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$account['email']?></td>
					</tr>
					 <tr>
						<td>Role:</td>
						<td><?=$account['role']?></td>
					</tr>
				</table>
				<a class="profile-btn" href="profile.php?action=edit">Edit Details</a>
			</div>
		</div>
		<?php elseif ($_GET['action'] == 'edit'): ?>
		<div class="content profile">
			<h2>Edit Profile Page</h2>
			<div class="block">
				<form action="profile.php?action=edit" method="post">
					<label for="username">Username</label>
					<input type="text" value="<?=$_SESSION['name']?>" name="username" id="username" placeholder="Username">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" placeholder="Password">
					<label for="cpassword">Confirm Password</label>
					<input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password">
					<label for="email">Email</label>
					<input type="email" value="<?=$account['email']?>" name="email" id="email" placeholder="Email">
					<br>
					<input class="profile-btn" type="submit" value="Save">
					<p><?=$msg?></p>
				</form>
			</div>
		</div>
		<?php endif; ?>
	</body>
</html>
