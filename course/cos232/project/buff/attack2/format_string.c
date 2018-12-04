#include <stdio.h>

// scenario: 
// Log in program asking for user name.
// print out the username and how much money they have, (should be 0)

int main() {
	int money = 0;
	printf("Address of money: %p\n", &money); // just for convenience
	char username[50];
	printf("Enter your username: ");
	fgets(username, 50, stdin);
	printf("Hi, ");
	printf(username);
	printf("You have $%d in your account.\n", money);
	return 0;
}
