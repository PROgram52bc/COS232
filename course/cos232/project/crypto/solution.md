# Part 2: Encrypt a file

## Decryption instruction

1. Go to the repo directory `course/cos232/project/crypto/sym\_enc/`
1. Pull `passphrase.gpg`, `stanley.jpg.enc` from the repository.
1. Make sure `gpg` is installed, and that your gpg private key is available on the machine. (Run `gpg --list-secret-keys` to verify)
1. Run the following command:

    ```
    gpg --output stanley.jpg --batch --passphrase-file <(gpg --decrypt passphrase.gpg 2>/dev/null) --decrypt stanley.jpg.enc
    ```
    
1. The decrypted file should be available in the current directory, named `stanley.jpg`

## Questions

### Did you use asymmetric or symmetric encryption?

I used asymmetric encryption to encrypt the passphrase, and symmetric encryption to encrypt the actual data.

### What are the keys for the cryptosystem? 

Keys include your private pgp key, and a passphrase.

### What are the algorithms used by the cryptosystem? 

Symmetric encryption uses AES encryption, while asymmetric uses RSA key pairs to encrypt.

### What are the strengths and weakness of your approach?

Strengths include that it doesn't require typing or storing the passphrase in plaintext, weakness include that it might be difficult to debug when there is an error.


# Part 3: Encrypt an email

## Instructions

1. Check your email, and search for mails from <david_deng@taylor.edu>
1. Open the most recent one.
1.
	* If you have an email client that supports pgp encryption, it should be automatically decrypted.
	* If you don't have an email client, download the attachment named `encrypted.asc` and run the following command

		```
		gpg --output out.mime --decrypt encrypted.asc
		```

        The decrypted file named `out.mime` should be available in the MIME format.
	

## Questions

### Did you use asymmetric or symmetric encryption?

I used asymmetric encryption.

### What are the keys for the cryptosystem? 

Keys are your public/private key pairs.

### What are the algorithms used by the cryptosystem? 

It uses RSA key pairs to encrypt and decrypt.

### What are the strengths and weakness of your approach?

Strengths include that it is relative easy to use with a pgp email client; weakness include that it might be difficult to configure the client.

