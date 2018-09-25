#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <ctype.h>
void usage(char* name) {
	fprintf(stderr, "Usage: %s [-e|-d] [shift value] [input file]\n", name);
	exit(-1);
}
int main(int argc, char** argv) {
	if (argc > 4) 
	{
		fprintf(stderr, "Too many arguments!\n");
		usage(argv[0]);
	}
	char mode = 'e';
	int shift = 7;
	FILE* inFile = stdin;
	int argn = 1; // the argument index to be processed
	if (argn < argc && argv[argn][0] == '-' && strlen(argv[argn]) == 2 && !isdigit(argv[argn][1])) 
		// if first argument like -? where ? is not a digit
	{
		switch (argv[argn][1]){
			case 'e':
				break;
			case 'd':
				mode = 'd';
				break;
			default:
				fprintf(stderr, "Invalid argument: %s\n", argv[argn]);
				usage(argv[0]);
		}
		argn++;
	}
	if (argn < argc && atoi(argv[argn]) != 0) // if next argument is a valid number
	{
		shift = atoi(argv[argn]) % 26;
		argn++;
	}
	if (argn < argc)
	{
		inFile = fopen(argv[argn], "r");
		if (inFile == NULL) 
		{
			fprintf(stderr, "Invalid argument: %s\n", argv[argn]);
			usage(argv[0]);
		}
		argn++;
	}
	if (argn < argc){
		fprintf(stderr, "Unprocessed argument: %s\n", argv[argn]);
		usage(argv[0]);
	}
	if (mode == 'd') shift *= -1; // reverse the order if in decrypt mode
	shift = shift<0 ? 26+shift : shift; // make shift in the range of [0,25]

	char inChar; // buffer for input
	char outChar; // buffer for output
	while (fread(&inChar, 1, 1, inFile) == 1) // as long as there is something coming
	{
		if (inChar >= 'a' && inChar <= 'z') // if lower case
			outChar = (inChar - 'a' + shift) % 26 + 'a';
		else if (inChar >= 'A' && inChar <= 'Z') // if upper case
			outChar = (inChar - 'A' + shift) % 26 + 'A';
		else outChar = inChar;
		fwrite(&outChar, 1, 1, stdout);
	}
	return 0;


}
