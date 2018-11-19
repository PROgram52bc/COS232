# MILESTONE 1

## Already implemented protection mechanisms
---

> Messages, including the title of a post, should: only be viewable by registered users, only be submitted by registered users, only be deleted by registered users.

* Yes. There is a mechanism in the php that hides info and restricts operations from unregistered user.

## Vulnerablilities and improvements

---
> Should enforce a strong password scheme, including at minimum:
> * Password should be longer than 8 characters in length
> * Password should not be a dictionary word

* There is no length/complexity checking on user password, which makes the system password more vulnerable to brute-force attack.
	* Check and make sure the password length is greater than 8 chars.
	* Do a simple case-insensitive check, refuse any password with only a dictionary word.
---
> If attackers obtain a copy of the database, user passwords should not be easily obtainable

* Passwords were stored in plaintext in the database.
	* Store a hash value of the password.
---
> Attackers should not be able to use snooping to obtain user credentials
>	* HTTPS is not an option

* Requests were sent in plain text that is vulnerable to snooping.
	* Though very ugly, fixed using a client side asymmetric encryption for the password field, which is decrypted on the server side with the private key.

---
> Should resist brute-force attacks aimed at guessing user passwords

* There is no limit or delay in false password attempt, which makes it vulnerable to a brute-force attack.
	* Implement a max-fail attempt check, one can fail a maximum of 3 times within 10 minutes.
