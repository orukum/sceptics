<?php
/**
 * Generates a random nonce 192-bit nonce
 */
function getNonce() {
	return base64URL_encode(random_bytes(24));
}

/**
 * Generates a 384-bit shared secret
 */
function getSecret() {
	return base64URL_encode(random_bytes(48));
}

/**
 * Transforms a byte string to a base64url encoded string
 */
function base64URL_encode($bytes) {
	return strtr(base64_encode($bytes), '+/', '-_');
}

/**
 * Transforms a string to a decoded byte string
 */
function base64URL_decode($str) {
	return base64_decode(strtr($str, '-_', '+/'));
}
?>
