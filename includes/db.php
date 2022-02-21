<?php
include 'auth.inc';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$SQL = new mysqli($SQL_SERVER, $SQL_USER, $SQL_PASSWORD, $SQL_DATABASE);

/**
 * Inserts a username and secret into the `Users` table
 * @param {string} user - a username
 * @param {string} secret - a shared 320-bit base-32 encoded secret
 */
function createUser(&$user, &$secret) {
	static $stmt = $SQL->prepare('INSERT INTO Users (Name, TOTP_Secret) VALUES (?, ?)');
	mysqli_stmt_bind_param($stmt, 'ss', $user, $secret);
	
	return mysqli_stmt_execute($stmt);
}

function checkUser(&$user) {
	static $stmt = $SQL->prepare('SELECT Id FROM Users WHERE Name=?');
	mysqli_stmt_bind_param($stmt, 's', $user);

	if(mysqli_stmt_execute($stmt)) {
		return mysqli_num_rows(mysqli_stmt_get_result($stmt));
	} else {
		return false;
	}
}

/**
 * Returns the secret for a given username or an error message
 * @param {string} user - a username
 */
function checkTOTP(&$user) {
	static $stmt = $SQL->prepare('SELECT TOTP_Secret FROM Users WHERE Name=?');
	mysqli_stmt_bind_param($stmt, 's', $user);

	if(mysqli_stmt_execute($stmt)) {
		return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))['TOTP_Secret'];
	} else {
		return false;
	}
}
?>