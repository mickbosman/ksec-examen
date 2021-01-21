<?php
include 'main.php';
$msg = '';
// Hier kijken we of de Email en code bestaan.
if (isset($_GET['email'], $_GET['code']) && !empty($_GET['code'])) {
	$stmt = $pdo->prepare('SELECT * FROM accounts WHERE email = ? AND activation_code = ?');
	$stmt->execute([ $_GET['email'], $_GET['code'] ]);
	// Dit slaat het resultaat op zodat we kunnen zien of het account bestaat in de database.
	$account = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($account) {
		// Het account bestaat met de aangevraagde email en code.
		$stmt = $pdo->prepare('UPDATE accounts SET activation_code = ? WHERE email = ? AND activation_code = ?');
		// Dit set de nieuwe activatie code naar 'activated' zodat we kunnen zien of de gebruiker zijn account heeft geactiveerd.
		$activated = 'activated';
		$stmt->execute([ $activated, $_GET['email'], $_GET['code'] ]);
		$msg = 'Your account is now activated, you can now login!<br><a href="index.php">Login</a>';
	} else {
		$msg = 'The account is already activated or doesn\'t exist!';
	}
} else {
	$msg = 'No code and/or email was specified!';
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Activate Account</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body class="loggedin">
		<div class="content">
			<p><?=$msg?></p>
		</div>
	</body>
</html>
