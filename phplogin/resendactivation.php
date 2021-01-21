<?php
include 'main.php';
// Laat bericht zien
$msg = '';
// dit controleerd of de e-mail van het activerings formulier opnieuw is verzonden, isset () controleert of de e-mail bestaat.
if (isset($_POST['email'])) {
    // dit bereid onze SQL voor,
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE email = ? AND activation_code != "" AND activation_code != "activated"');
    $stmt->execute([ $_POST['email'] ]);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);
    // Als het account bestaat met de e-mail
    if ($account) {
        // Account bestaat, de $ msg-variabele wordt gebruikt om het uitvoerbericht te tonen (op het HTML-formulier)
        send_activation_email($_POST['email'], $account['activation_code']);
        $msg = 'Activaton link has been sent to your email!';
    } else {
        $msg = 'We do not have an account with that email!';
    }
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Resend Activation Email</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
		<div class="login">
			<h1>Resend Activation Email</h1>
			<form action="resendactivation.php" method="post">
                <label for="email">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="Your Email" id="email" required>
				<div class="msg"><?=$msg?></div>
				<input type="submit" value="Submit">
			</form>
		</div>
	</body>
</html>
