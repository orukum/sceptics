<?php
require_once 'db.php';
require_once 'utils.php';

session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	// TODO: Handle login
	return http_response_code(405);
} elseif($_SERVER['REQUEST_METHOD'] === 'GET') {

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
	<title>Log in to Sceptics</title>
	<link rel="stylesheet" href="styles/shell.css">
	<link rel="stylesheet" href="styles/main.css">
	<script type="module" src="modules/shell.js" defer></script>
</head>
<body>
	<h1 id="heading">LOG IN</h1>
	<form action="auth.php">
		<label for="username">USERNAME</label>
		<input id="username" name="username" type="text"/>
		<label for="totp">TOTP</label>
		<input id="totp" name="totp" type="text"/>
		<button type="submit">Submit</button>
	</form>
	<p id="signup-text">New to Sceptics? <a id="signup" href="register.php">Sign up!</a></p>
	<script type="module">
		import {shell} from './modules/shell.js';
		shell.show();
	</script>	
</body>
</html>