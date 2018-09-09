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
	int count;
	count = fread(buf, 1, 14, inputFile);
	if (count != 14) 
	{
		fprintf(stderr, "Unexpected EOF.\n");
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
	fwrite(buf, 1, 14, outputFile); // parallel writing to output file.
	// END processing header

	count = fread(buf, 1, pixelPos-14, inputFile);
	if (count != pixelPos-14) 
	{
		fprintf(stderr, "Unexpected EOF.\n");
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
	// fprintf(stdout, "bits per pixel: %hu.\n", bitsPerPixel);
	fwrite(buf, 1, pixelPos-14, outputFile); // parallel writing to output file.
	// END processing DIB header

	while (fread(buf, 1, 1, inputFile) == 1) // read byte by byte 
	{
		fwrite(buf, 1, 1, outputFile); // parallel writing to output file.
	}

	return 0;

}
