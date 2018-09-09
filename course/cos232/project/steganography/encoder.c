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
	// fprintf(stdout, "Your message is: %s\n", message);
	char buf[BUFSIZ];
	if (fgets(buf, 15, inputFile) == NULL) // 14 + 1 (\0)
	{
		fprintf(stderr, "Failed to read file %s.\n", argv[1]);
		exit(-2);
	}
	if (buf[0] != 'B' || buf[1] != 'M')
	{
		fprintf(stderr, "Input file is not a bmp file.\n");
		exit(-3);
	}
	// START processing header
	int pixelPos = (int)buf[10];
	fprintf(stdout, "Pixel Array Start at: %d.\n", pixelPos);
	// END processing header

	if (fgets(buf, pixelPos-14+1, inputFile) == NULL)
	{
		fprintf(stderr, "Failed to read file %s.\n", argv[1]);
		exit(-2);
	}
	// START processing DIB header
	char* pos = buf+4;
	int width = *(int*)(pos);
	pos+=4; // skip the width field
	int height = *(int*)(pos);
	pos+=6; // skip the height field and plane field
	unsigned short bitsPerPixel = (pos[1] << 8) | pos[0]; // only for big endian system

	fprintf(stdout, "Width: %d.\n", width);
	fprintf(stdout, "Height: %d.\n", height);
	// fprintf(stdout, "bit per pixel: %hu.\n", bitsPerPixel);

	// END processing DIB header
	


	return 0;

}
