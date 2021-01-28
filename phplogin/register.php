<?php
include 'main.php';
// ! Controle of alle data is ingevuld
if (!isset($_POST['username'], $_POST['password'], $_POST['cpassword'], $_POST['email'])) {
	// Bericht als dat niet zo is
	exit('Please complete the registration form!');
}
// ! Check of er niks leeg is gelaten
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	// Bericht als dat wel zo is
	exit('Please complete the registration form');
}
// ! Check of de email juist is
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	exit('Email is not valid!');
}
// ! Username mag alleen deze tekens bevatten
if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['username'])) {
    exit('Username is not valid!');
}
// Het wachtwoord moet tussen de 5 en 20 letters zijn
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	exit('Password must be between 5 and 20 characters long!');
}
// Het wachtwoord mag alleen deze tekens bevatten
if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['password'])) {
	exit('Password is not valid!');
}
// ! Check of allebij de wachtwoord velden gelijk zijn
if ($_POST['cpassword'] != $_POST['password']) {
	exit('Passwords do not match!');
}
// ! Check of er al een account is met deze naam
$stmt = $pdo->prepare('SELECT id, password FROM accounts WHERE username = ? OR email = ?');
$stmt->execute([ $_POST['username'], $_POST['email'] ]);
$account = $stmt->fetch(PDO::FETCH_ASSOC);

if ($account) {
	// Als de naam al bestaat
	echo 'Username and/or email exists!';
} else {
	// ! Als de naam niet bestaat, Maak hem dan aan
	$stmt = $pdo->prepare('INSERT INTO accounts (username, password, email, activation_code, ip) VALUES (?, ?, ?, ?, ?)');
	// ! Wachtwoord hash
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$uniqid = account_activation ? uniqid() : 'activated';
	$ip = $_SERVER['REMOTE_ADDR'];
$stmt->execute([ $_POST['username'], $password, $_POST['email'], $uniqid, $ip ]);	if (account_activation) {
		// ! email verificatie
		send_activation_email($_POST['email'], $uniqid);
		echo 'Please check your email to activate your account!';
	} else {
		// Als alles goed is kan er worden ingelogd met het account
		echo 'You have successfully registered, you can now login!';
	}
}
?>
