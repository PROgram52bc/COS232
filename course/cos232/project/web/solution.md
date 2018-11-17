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


# MILESTONE 2

## Malicious website

I used a fake google page template as the content of the malicious website, where both the buttons (google search and feeling lucky) will send a post request to the hackme server, posting spam message. 
A victim could have been redirected to the page by pop-ups, substituted browser icon, etc. Victim is extremely likely to be lured because the page just looks like the google page. (Maybe it can be furture changed to look more like it) And most web users (e.g. myself) would not consider clicking on the search button as dangerous, since they do it all the time.
It can be viewed at [here](https://cse.taylor.edu/~hdeng/google-homepage/csrf.html)

## Fix on the server

I implemented the protection using a hidden token field in the form, whose value is set to the user's hashed password. Whenenver the post request is detected, the server will check that field's value against the user's hashed password in the database, so in the CSRF attack, the attacker would not likely to know the hashed value, thus fail the test.

