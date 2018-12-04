#include <stdio.h>

int main() {
	short root = 0; // not root
	short user_id; // a number from 0-65535
	printf("Enter your id number: ");
	scanf("%d", &user_id); // vulnerable! 
	if (root) printf("You are root now!\n"); // shouldn't print
	return 0;
}
