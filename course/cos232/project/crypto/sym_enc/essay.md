# Symmetric Encryption/decryption instructions

## Decryption instruction

1. Pull `passphrase.gpg`, `stanley.jpg.enc` from the repository.
2. Make sure `gpg` is installed, and that your gpg private key is available on the machine. (Run `gpg --list-secret-keys` to verify)
3. Run the following command:

    ```
    gpg --output stanley.jpg --batch --passphrase-file <(gpg --decrypt passphrase.gpg 2>/dev/null) --decrypt stanley.jpg.enc
    ```
    
4. The decrypted file should be available in the current directory, named `stanley.jpg`

## Questions

### Did you use asymmetric or symmetric encryption?

I used asymmetric encryption to encrypt the passphrase, and symmetric encryption to encrypt the actual data.

### What are the keys for the cryptosystem? 

Keys include your private pgp key, and a passphrase.

### What are the algorithms used by the cryptosystem? 

Symmetric encryption uses AES encryption, while asymmetric uses RSA key pairs to encrypt.

### What are the strengths and weakness of your approach?

Strengths include that it doesn't require typing or storing the passphrase in plaintext, weakness include that it might be difficult to debug when there is an error.
