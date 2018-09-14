#include <stdio.h>
#include <string.h>
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
	if (bitsPerPixel != 24 && bitsPerPixel != 32) 
	{
		fprintf(stderr, "Unrecognized bits per pixel value: %hd", bitsPerPixel);
		exit(-1);
	}
	fprintf(stdout, "Width: %d.\n", width);
	fprintf(stdout, "Height: %d.\n", height);
	// fprintf(stdout, "bits per pixel: %hu.\n", bitsPerPixel);
	fwrite(buf, 1, pixelPos-14, outputFile); // parallel writing to output file.
	// END processing DIB header
	// START writing to output file with encoding
	short bitCount = 0; // the current bit number to be read out of the 8 bits in a char. n E [0,7]
	int letterIndex = 0; // the index of the current letter. n E [0,strlen(message)-1]
	for (int i=0;;i++)
	{
		// checking conditions for exiting loops
		if (letterIndex > strlen(message)) // when finished reading the string (> because should include the final \0)
		{
			break; 
		}

		// LSB last
	//	unsigned char mask = 1<<(7-bitCount);
	//	unsigned char bit = (message[letterIndex] & mask) >> (7-bitCount); // the bitCount'th bit of the letter. n E {0,1}
		// LSB first	
		unsigned char bit = ( (message[letterIndex]>>bitCount)%2)==1;

		unsigned char tmp;
		if (fread(&tmp, 1, 1, inputFile) != 1) {
			fprintf(stderr, "Image file terminated before all info are stored.\n");
			exit(-1);
		}
		if (bitsPerPixel == 32 && (i+1)%4==0) 
		{
			fwrite(&tmp, 1, 1, outputFile);
			continue; // skip the Alpha byte
		}
		fprintf(stdout, "oldTmp: %x. ", tmp);
		if (bit) // if should set 1
			tmp |= 1;
		else // if should set 0
			tmp &= ~1;
		fprintf(stdout, "Writing %hd to file: %x\n", bit, tmp);
		fwrite(&tmp, 1, 1, outputFile); // parallel writing to output file.
		// increment counts
		if (bitCount<7) { 
			bitCount++;
		}
		else {
			bitCount = 0;
			letterIndex++;
			fprintf(stdout, "\n");
		}

	}
	while (fread(buf, 1, 1, inputFile) == 1)
		fwrite(buf, 1, 1, outputFile);
	// END writing to output file with encoding

	return 0;

}
