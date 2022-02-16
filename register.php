<?php
require_once 'db.php';
require_once 'utils.php';

session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	
	return http_response_code(405);
} elseif($_SERVER['REQUEST_METHOD'] === 'GET') {
	if(!isset($_SESSION['nonces'])) {
		$_SESSION['nonces'] = array('register' => getNonce());
	} else {
		$_SESSION['nonces']['register'] = getNonce();
	}
} else {
	return http_response_code(405);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Register on Sceptics</title>
	<link rel="stylesheet" href="styles/main.css">
	<script src="lib/qrcode.js"></script>
</head>
<body>
	<h1 id="heading">SIGN UP</h1>
	<form action="register.php">
		<label for="username">USERNAME</label>
		<input id="username" name="username" type="text"/>
		<input name="nonce" type="hidden" value="<?php echo $_SESSION['nonces']['register'] ?>"/>
		<button type="submit">Submit</button>
		<!--div id="qrcode" style="background-color: white; width: 500px;"></div-->
	</form>
	<p>Already registered? <a id="login" href="login.php">Log in!</a></p>
	<script>
		const $ = document.querySelector.bind(document), $$ = document.querySelectorAll.bind(document);

		/*let issuer = 'Sceptics', user = 'andrew@test.com', secret = 'XBM654Q4DDJKFGPDXZRBD3X533ATI5ZYRLQ4LRQF6XLUJOFHTH2JTBOC3M5SK2T6';
		console.log('otpauth://totp/' + issuer + '?secret=' + secret);
		QRCode.toString('otpauth://totp/' + issuer + '?secret=' + secret, {errorCorrectionLevel: 'H', type: 'svg'}).then(function(svg) {
			$('#qrcode').innerHTML = svg;
		});*/
	</script>	
</body>
</html>