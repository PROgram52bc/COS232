<?php /* To use this file: 
There should be a file in the current directory called public.key,
There should be a file in the current directory called jsencrypt.js, including the javascript implementation for rsa encryption,
There should be a form element called 'userform',
Inside 'userform, there should be a submit button, and a password field.
As an output:
A hidden field containing base-64 encoding of the password is appended to the form, with an id 'encrypted-password', and password field is set to AbCd001234, which should not be used.
The server side should do the reverse with a public key, which is extremly laborious and hard to debug and time consuming and not wise. But I really can't think of any other solution right now other than using https. SAD
 */
?>	
<p id="public_key" hidden> <?php echo file_get_contents("public.key") ?></p>
<script src="jsencrypt.js"></script>
<script>
console.log(userform);
let submitButton = userform.querySelector("input[name=submit]");
console.log(public_key.innerHTML);

submitButton.addEventListener("click", function() {
	// event.preventDefault();
	let passwordField = userform.querySelector("input[name=password]");
	let enc = new JSEncrypt();
	enc.setPublicKey(public_key.innerHTML);
	let encryptedPassword = enc.encrypt(passwordField.value);
	console.log(encryptedPassword);
	userform.insertAdjacentHTML('beforeend', `<input name='encrypted-password' value=${encryptedPassword} hidden></input>`);
	passwordField.value = "AbCd001234";
})
</script>
