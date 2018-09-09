#include <stdio.h>
#include <stdlib.h>

int main(int argc, char* argv[]) {
	if (argc != 4)
	{
		fprintf(stderr, "Usage: %s input.bmp output.bmp [secret message]\n", argv[0]);
		exit(-1);
	}
	FILE* inputFile = fopen(argv[1], "r");
	FILE* outputFile = fopen(argv[2], "w");
	char* message = argv[3];
	fprintf(stdout, "Your message is: %s\n", message);
	return 0;

}
