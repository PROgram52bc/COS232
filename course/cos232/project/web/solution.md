# MILESTONE 1

## Already implemented protection mechanisms

> Messages, including the title of a post, should: only be viewable by registered users, only be submitted by registered users, only be deleted by registered users.
1. Yes. There is mechanism in the php that hides info and restricts operations from unregistered user.

## Vulnerablilities and improvements

> Should enforce a strong password scheme, including at minimum:
> 	* Password should be longer than 8 characters in length
> 	* Password should not be a dictionary word
1. There is no length/complexity checking on user password, which makes the system password more vulnerable to brute-force attack.
	* Check and make sure the password length is greater than 8 chars.
	* Attempted to do a spell check, but the pspell library was not loaded in the current configuration. 

> If attackers obtain a copy of the database, user passwords should not be easily obtainable
1. Passwords were stored in plaintext in the database.
	* Store a hash value of the password.

> Attackers should not be able to use snooping to obtain user credentials
>	* HTTPS is not an option
1. Requests were sent in plain text that is vulnerable to snooping.
	*

> Should resist brute-force attacks aimed at guessing user passwords
1. There is no limit or delay in false password attempt, which makes it vulnerable to a brute-force attack.
	* 
