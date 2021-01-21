<?php
include 'main.php';
// ! Kijkt hoeveel login attempts er nog over zijn. Goed tegen brute force aanvallen
$login_attempts = loginAttempts($pdo, FALSE);
if ($login_attempts && $login_attempts['attempts_left'] <= 0) {
	exit('You cannot login right now please try again later!');
}

// ! Hier kijken we of de data van de login is verstuurd, isset() kijkt of de data bestaat.
if (!isset($_POST['username'], $_POST['password'])) {
	$login_attempts = loginAttempts($pdo);

	// Kan de data niet krijgen wat verstuurd had moeten worden.
	exit('Please fill both the username and password field!');
}
// ! Bereid SQL statments voor. Dit gaat SQL injections tegen
$stmt = $pdo->prepare('SELECT * FROM accounts WHERE username = ?');
$stmt->execute([ $_POST['username'] ]);
$account = $stmt->fetch(PDO::FETCH_ASSOC);

// Kijkt of het acount bestaat
if ($account) {
	// Het account bestaat dus bevistigen we het wachtwoord.
	if (password_verify($_POST['password'], $account['password'])) {
		// Kijkt of het account is geactiveerd
		if (account_activation && $account['activation_code'] != 'activated') {
			// De gerbuiker heeft zijn account nog niet geactiveerd, dus stuurd het een bericht
			echo 'Please activate your account to login, click <a href="resendactivation.php">here</a> to resend the activation email!';

				// 2-stap authenticator, staat uit omdat het niet werkt op localhost //

	//	} else if ($_SERVER['REMOTE_ADDR'] != $account['ip']) {
	// Two-factor authentication required
//	$_SESSION['2FA'] = uniqid();
//	echo '2FA: twofactor.php?id=' . $account['id'] . '&email=' . $account['email'] . '&code=' . $_SESSION['2FA'];

} else {
			// Verificatie is geslaagd! De gebruiker is ingelogd!
			// Maakt een sessie zodat we weten dat de gebruiker is ingelogd.
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $account['username'];
			$_SESSION['id'] = $account['id'];
			$_SESSION['role'] = $account['role'];
			// Als de gebruiker de remember me knop heeft aangevinkt:
			if (isset($_POST['rememberme'])) {
				// Maakt een Hash en word opgeslagen als een coockie en in de database, dit gebruiken we zodat we de gebruiker kunnen identificeren.
				$cookiehash = !empty($account['rememberme']) ? $account['rememberme'] : password_hash($account['id'] . $account['username'] . 'yoursecretkey', PASSWORD_DEFAULT);
				// Het aantal dagen dat de gebruiker herinnerd word:
				$days = 30;
				setcookie('rememberme', $cookiehash, (int)(time()+60*60*24*$days));
				/// Dit werkt de "rememberme" feld bij in het accouts tabel.
				$stmt = $pdo->prepare('UPDATE accounts SET rememberme = ? WHERE id = ?');
				$stmt->execute([ $cookiehash, $account['id'] ]);
			}
			echo 'Success'; // Deze lijn checkt de AJAX code.
		}
	} else {
		// Verkeerde wachtwoord
		$login_attempts = loginAttempts($pdo, TRUE);
echo 'Incorrect username and/or password, you have ' . $login_attempts['attempts_left'] . ' attempts remaining!';
	}
} else {
	// Verkeerde wachtwoord
	$login_attempts = loginAttempts($pdo, TRUE);
echo 'Incorrect username and/or password, you have ' . $login_attempts['attempts_left'] . ' attempts remaining!';
}
?>
