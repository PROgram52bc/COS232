# Attack 1

## Type of vulnerability/attack
Stack-based buffer overflow
## Why the code is vulnerable
Because it uses %d (expecting a 4-byte integer) to read a character (which is 1 byte). Therefore, part of the input could overflow.
## How the exploit works
When asked for input, enter a number greater than 255 (the maximum value for 1 byte unsigned char), which would be interpreted as a valid 4-byte integer and overflow to the next byte in memory, which turns out to be the address for the "root flag."
## How to prevent the attack
Use %c to match characters in scanf instead of %d.
## Potential payoff of the attack
If this vulnerable program is used in a critical system, root privilege could be exploited on that system, which involve the confidentiality of sensitive information, integrity of critical data, and availability of the services that the system provide.
