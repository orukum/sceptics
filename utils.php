<?php
/**
 * Generates a random nonce 192-bit nonce
 */
function getNonce() {
	return base64URL_encode(random_bytes(24));
}

/**
 * Generates a 320-bit shared secret
 */
function getSecret() {
	return base32_encode(random_bytes(40));
}

/**
 * Transforms a byte string to a PHP base-32 string
 */
function bintobase32($hex) {
	return gmp_strval(gmp_init(bin2hex($hex), 16), 32);
}

/**
 * Transforms a PHP base-32 string to a byte string
 */
function base32tobin($base32) {
	return hex2bin(gmp_strval(gmp_init($base32, 32), 16));
}

/**
 * Transforms a (RFC 4648) byte string to a base-32 encoded string
 * Note: Does not add padding
 */
function base32_encode($bytes) {
	return strtr(bintobase32($bytes), '0123456789abcdefghijklmnopqrstuv', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567');
}

/**
 * Transforms a (RFC 4648) base-32 encoded string to a decoded byte string
 * Note: Does not remove padding
 */
function base32_decode($str) {
	return base32tobin(strtr($str, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567', '0123456789abcdefghijklmnopqrstuv'));
}

/**
 * Transforms a byte string to a base64url encoded string
 */
function base64URL_encode($bytes) {
	return strtr(base64_encode($bytes), '+/', '-_');
}

/**
 * Transforms a base64url encoded string to a decoded byte string
 */
function base64URL_decode($str) {
	return base64_decode(strtr($str, '-_', '+/'));
}

/**
 * Dynamically truncates a HMAC-SHA-1 (from RFC 4226)
 */
function dynamicTruncation($str) {
	$offset = hexdec(substr($str, -1)) * 2;
	return hexdec(substr($str, $offset, 8)) & 0x7FFFFFFF;
}

/**
 * Hashes and truncates a shared secret into a TOTP (from RFC 4226, RFC 6238)
 */
function getTOTP($secret, $step = 0) {
	$hs = hash_hmac('sha1', pack('N*', 0) . pack("N*", floor(time() / 30) + $step), $secret);
	return dynamicTruncation($hs) % 1000000;
}
?>
