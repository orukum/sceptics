<?php
/**
 * Generates a random nonce 96-bit nonce
 */
function getNonce() {
	return base64URL_encode(random_bytes(12));
}

/**
 * Generates a 320-bit shared secret
 */
function getSecret() {
	return base32_encode(random_bytes(40));
}

/**
 * Hashes and truncates a shared secret into a TOTP (from RFC 4226, RFC 6238)
 * @param {string} secret - a shared 320-bit base-32 encoded secret
 * @param {int} step - the number of intervals in the future or past
 */
function getTOTP(&$secret, $step = 0, $length = 6) {
	$hs = hash_hmac('sha1', pack('N*', 0) . pack("N*", floor(time() / 30) + $step), $secret);
	$snum = dynamicTruncation($hw) & 0x7FFFFFFF;
 	return str_pad($snum % pow(10, $length), $length, '0', STR_PAD_LEFT);
}

/**
 * Dynamically truncates a HMAC-SHA-1 (from RFC 4226)
 * @param {string} str - a hex string representing a HMAC-SHA-1
 */
function dynamicTruncation($str) {
	$offset = hexdec(substr($str, -1));
	return hexdec(substr($str, $offset * 2, 8));
}

/**
 * Transforms a byte string to a PHP base-32 string
 * @param {string} bytes - a byte string
 */
function bintobase32($bytes) {
	return gmp_strval(gmp_init(bin2hex($bytes), 16), 32);
}

/**
 * Transforms a PHP base-32 string to a byte string
 * @param {string} base32 - a base-32 string in PHP default encoding
 */
function base32tobin($base32) {
	return hex2bin(gmp_strval(gmp_init($base32, 32), 16));
}

/**
 * Transforms a byte string to a RFC 4648 base-32 encoded string
 * Note: Does not add padding
 * @param {string} bytes - a byte string
 */
function base32_encode($bytes) {
	return strtr(bintobase32($bytes), '0123456789abcdefghijklmnopqrstuv', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567');
}

/**
 * Transforms a RFC 4648 base-32 encoded string to a decoded byte string
 * Note: Does not remove padding
 * @param {string} base32 - a base-32 string in RFC 4648 encoding
 */
function base32_decode($base32) {
	return base32tobin(strtr($base32, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567', '0123456789abcdefghijklmnopqrstuv'));
}

/**
 * Transforms a byte string to a base-64 url-friendly encoded string
 * @param {string} bytes - a byte string
 */
function base64URL_encode($bytes) {
	return strtr(base64_encode($bytes), '+/', '-_');
}

/**
 * Transforms a base-64 url-friendly encoded string to a decoded byte string
 * @param {string} base64 - a base-64 url-friendly encoded string
 */
function base64URL_decode($base64) {
	return base64_decode(strtr($base64, '-_', '+/'));
}
?>
