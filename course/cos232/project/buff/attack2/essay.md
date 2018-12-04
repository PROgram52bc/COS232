# Attack 2

## Type of vulnerability/attack
Format string attack
## Why the code is vulnerable
Because the program used printf with a format string supplied by user input.
## How the exploit works
Since in the source code, printf only expects one argument, it imagines the stack to be like:

```
0x80 other data

0x64 arg1 (format string)

...

0x40 fixed padding <-- rsp
```

However, by supplying extra %x flags in the format string, we can trick the program into believing that we have more arguments, the more flags we have, the more random data will be read by printf up the stack, thinking that they are the actual arguments provided. At one point, it will read pass where the format string is actually stored.

The %n flag will write the number of bytes printed so far to the corresponding address specified by the argument. So we can put the address we want to override (in this case the address of money) at the beginning of the format string, pretending that it is the argument corresponding to the %n flag, and however many characters was written so far will be converted to an integer, and written into that address. We further exploit this feature by supplying a padding, making the number of characters written so far even larger.

## How to prevent the attack
Always supply the format string. In this case, use `printf("%s",user_input);` rather than `printf(user_input);`
## Potential payoff of the attack
Although there are difficulties to conduct this attack in a reliable way, (e.g. injecting \x00 as part of the address in a 64-bit machine, figuring out the address of variables in the presence of ASLR, etc.) it can definitely lead a system into unintended behaviors or states. This attack especially compromises the integrity of the system, by changing values in memory; if the variable it overrides involves privileges, confidentiality can also be compromised. It's also very easy to attack the system's availability, by supplying a format string that writes to invalid addresses. (e.g. "%n%n%n%n%n%n%n")

