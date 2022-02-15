<?php
	$SQL_SERVER = '';
	$SQL_USER = '';
	$SQL_PASSWORD = '';
	$SQL_DATABASE = '';

	$SQL = new mysqli($SQL_SERVER, $SQL_USER, $SQL_PASSWORD, $SQL_DATABASE);

	function createUser($user, $secret) {
		$query = 'INSERT INTO Users (Name, TOTP_Secret) VALUES (' . $user . ', ' . $secret . ')';
		
		if($SQL->query($query)) {
			return $secret;
		} else {
			return mysql_errno($SQL) . ": " . mysql_error($SQL);
		}
	}

	function getSecret($user) {
		$query = 'SELECT TOTP_Secret FROM Users WHERE Name="' . $user . '"';

		if($secret = $SQL->query($query)) {
			return $secret;
		} else {
			return mysql_errno($SQL) . ": " . mysql_error($SQL);
		}
	}
?>