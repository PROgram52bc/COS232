#include <stdio.h>
#include <stdlib.h>

typedef unsigned short bool;
void printUsageAndExit(char* progName) {
	printf("Usage: %s [-a] [arg1] [arg2] ... \n", progName);
	exit(1);
}

int main(int argc, char* argv[]) {
	if (argc == 1) 
		printUsageAndExit(argv[0]);
	int a = 1; // starting argument index
	bool optionAscii = 0;
	if (argv[1][0] == '-') // if option provided
	{
		if (argc == 2)
			printUsageAndExit(argv[0]);
		a = 2;
		if (argv[1][1] == 'a')
			optionAscii = 1;
	}

	for (a; a<argc; a++)
	{
		int num;
		if (optionAscii) num = argv[a][0]; 
		else num = atoi(argv[a]);
		if (num == 0)
			printUsageAndExit(argv[0]);
		printf("Ascii value: %c\n", num);
		printf("Dec value: %d\n", num);
		printf("Hex value: %x\n", num);
		printf("Binary representation: \n");
		short stack[8];
		for (int i=0; i<8; i++)
		{
			stack[i]=(num%2==1);
			num/=2;
		}
		for (int i=7; i>=0; i--)
		{
			printf("%1d ", stack[i]);
		}
		printf("\n\n");
	}
	printf("Note: The binary shows the least significant 2 bytes only.\n");
	return 0;
}
