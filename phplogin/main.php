<?php
// Het Main bestand bevat de databaseverbinding, sessie-initialisatie en functies, andere PHP-bestanden zijn afhankelijk van dit bestand.
//Voegt het configuratiebestand toe
include_once 'config.php';
// Start de sessie
session_start();
try {
	$pdo = new PDO('mysql:host=' . db_host . ';dbname=' . db_name . ';charset=' . db_charset, db_user, db_pass);
} catch (PDOException $exception) {
	// Als er een error is opgetreden bij de verbinding, dan stopt het script en geef de error aan.
	exit('Failed to connect to database!');
}
// deze functie controleert of de gebruiker is ingelogd en controleert ook de remember me cookie.
function check_loggedin($pdo, $redirect_file = 'index.php') {
	//Controleerd op "rememberme" cookie variabele en "loggedin" sessievariabele
    if (isset($_COOKIE['rememberme']) && !empty($_COOKIE['rememberme']) && !isset($_SESSION['loggedin'])) {
    	// Als de rememberme cookie overeenkomt met een in de database, kunnen we de sessievariabelen bijwerken.
    	$stmt = $pdo->prepare('SELECT * FROM accounts WHERE rememberme = ?');
    	$stmt->execute([ $_COOKIE['rememberme'] ]);
    	$account = $stmt->fetch(PDO::FETCH_ASSOC);
    	if ($account) {
    		// de match is gevonden, de sessievariabelen worden bijgewerkt en houdt de gebruiker ingelogd
    		session_regenerate_id();
    		$_SESSION['loggedin'] = TRUE;
    		$_SESSION['name'] = $account['username'];
    		$_SESSION['id'] = $account['id'];
			$_SESSION['role'] = $account['role'];
    	} else {
    		// ALs de gebruiker niet herinnerd word dan word hij verwijst naar de login pagina.
    		header('Location: ' . $redirect_file);
    		exit;
    	}
    } else if (!isset($_SESSION['loggedin'])) {
    	// ALs de gerbuiker niet ingelogd is dan word hij verwijst naar de login pagina.
    	header('Location: ' . $redirect_file);
    	exit;
    }
}

function loginAttempts($pdo, $update = TRUE) {
	$ip = $_SERVER['REMOTE_ADDR'];
	$now = date('Y-m-d H:i:s');
	if ($update) {
		$stmt = $pdo->prepare('INSERT INTO login_attempts (ip_address, `date`) VALUES (?,?) ON DUPLICATE KEY UPDATE attempts_left = attempts_left - 1, `date` = VALUES(`date`)');
		$stmt->execute([$ip,$now]);
	}
	$stmt = $pdo->prepare('SELECT * FROM login_attempts WHERE ip_address = ?');
	$stmt->execute([$ip]);
	$login_attempts = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($login_attempts) {
		// De gebruiker kan na 1 dag weer proberen in te loggen
		$expire = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($login_attempts['date'])));
		if ($now > $expire) {
			$stmt = $pdo->prepare('DELETE FROM login_attempts WHERE ip_address = ?');
			$stmt->execute([$ip]);
			$login_attempts = array();
		}
	}
	return $login_attempts;
}

// dit is de activatie e-mail functie
function send_activation_email($email, $code) {
	$subject = 'Account Activation Required';
	$headers = 'From: ' . mail_from . "\r\n" . 'Reply-To: ' . mail_from . "\r\n" . 'Return-Path: ' . mail_from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
	$activate_link = activation_link . '?email=' . $email . '&code=' . $code;
	$email_template = str_replace('%link%', $activate_link, file_get_contents('activation-email-template.html'));
	mail($email, $subject, $email_template, $headers);
}
?>
