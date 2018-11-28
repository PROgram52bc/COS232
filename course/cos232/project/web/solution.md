# MILESTONE 1

## Vulnerablilities and improvements

---

> Messages, including the title of a post, should: only be viewable by registered users, only be submitted by registered users, only be deleted by registered users.

* No, if user has a cookie of 'hackme' set, they will be permitted to act as users already logged in.
	* Check if the 'hackme' field of the cookie correspond to an actual username in the database, and whether the 'hackme\_pass' in the cookie correspond to the correct password in the DB.

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

# MILESTONE 3

## Malicious message

I constructed a malicious message payload with `<script>` tags that uses javascript to send the user's cookies with an ajax request to a remote server. Since the cookie is hashed, the credential password stolen cannot be used as the login password directly; however, an attacker might set his/her own cookie with the stolen credential thus log in as the victim user.

I made a pseudo-server with a subdirectory called `xss\_server` in the `src` folder. There are three files: 
* `database.txt` stores all the credentials stolen, 
* `collector.php` is the server receiving requests with user credentials, and
* `malicious_message.txt` is the message payload to be posted on the bulletin board.

## Fix on the server

I used a simple input sanitization to strip out all html tags. Now the previous attack would not work, since the `<script>` tags were removed from the user input and all the statements will be displayed instead of being interpreted by javascript on the victim's browser.
