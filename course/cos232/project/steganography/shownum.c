#include <stdio.h>
#include <stdlib.h>

int main(int argc, char* argv[]) {
	if (argc == 1) 
	{
		printf("Usage: %s [num1] [num2] ... \n", argv[0]);
		exit(1);
	}
	for (int a=1; a<argc; a++)
	{
		int num = atoi(argv[a]);
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
