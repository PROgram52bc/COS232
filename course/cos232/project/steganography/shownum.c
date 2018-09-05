#include <stdio.h>
#include <stdlib.h>

int main(int argc, char* argv[]) {
	int num = atoi(argv[1]);
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
	printf("\n");
	return 0;
}
