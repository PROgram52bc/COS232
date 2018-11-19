<?php
/* To use this function:
		There should be a file called private.key including the private key
		Pass the 64base encoded password as argument,
		The plaintext password is returned. SAD SAD SAD :(
*/
function getPlainPassWord($encryptedPassword) {
	$fp = fopen("private.key", "r");
	$key = fread($fp, 8192);
	openssl_private_decrypt(base64_decode($encryptedPassword), $plain_pass, $key);
	// var_dump($plain_pass);
	return $plain_pass;
}
?>
