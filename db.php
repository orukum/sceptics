<?php
$SQL_SERVER = '';
$SQL_USER = '';
$SQL_PASSWORD = '';
$SQL_DATABASE = '';

$SQL = new mysqli($SQL_SERVER, $SQL_USER, $SQL_PASSWORD, $SQL_DATABASE);

/**
 * Inserts a username and secret into the `Users` table
 * @param {string} user - a username
 * @param {string} secret - a shared 320-bit base-32 encoded secret
 */
function createUser($user, $secret) {
	$query = 'INSERT INTO Users (Name, TOTP_Secret) VALUES (' . $user . ', ' . $secret . ')';
	
	if($SQL->query($query)) {
		return $secret;
	} else {
		return mysql_errno($SQL) . ": " . mysql_error($SQL);
	}
}

/**
 * Returns the secret for a given username or an error message
 * @param {string} user - a username
 */
function getSecret($user) {
	$query = 'SELECT TOTP_Secret FROM Users WHERE Name="' . $user . '"';

	if($secret = $SQL->query($query)) {
		return $secret;
	} else {
		return mysql_errno($SQL) . ": " . mysql_error($SQL);
	}
}
?>