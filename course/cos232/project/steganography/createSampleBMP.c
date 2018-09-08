#include <stdio.h>
#include <stdlib.h>
#include <fcntl.h> // creat(), open()
#include <unistd.h> // write(), read(), close()
#include <string.h>
#include <stdint.h>

struct bmp_info {

};

const char* filename = "Sample.bmp";
const int sizeOfBMPHeader = 14; // fixed
const int sizeOfDIBHeader = 40;
const int sizeOfData = 16;
char* insertInt(char* pos, int num) // 2 or 4 bytes, system-dependent. Endianess as well
{
	int* intpos = (int*) pos;
	*intpos++ = num;
	return (char*) intpos;
}
char* insertTwoBytes(char* pos, short num) // 2 bytes, endianess system-dependent.
{
	short* shortpos = (short*) pos;
	*shortpos++ = num;
	return (char*) shortpos;
}
char* insertPixel(char* pos, uint8_t R, uint8_t G, uint8_t B)
{
	*(pos++) = R;
	*(pos++) = G;
	*(pos++) = B;
	return pos;
}
int main()
{
	int sizeOfFile = sizeOfBMPHeader + sizeOfDIBHeader + sizeOfData; // in bytes
	creat(filename, 0644);
	int fd = open(filename, 1); // open in writing mode
	FILE* file = fopen(filename, "w");
	char buffer[BUFSIZ];
	char* pos = buffer;
	// header start
	*(pos++) = 'B';
	*(pos++) = 'M'; // header, 2 bytes
	pos = insertInt(pos, sizeOfFile); // insert sizeoffile (4 bytes) after it.
	pos = insertInt(pos, 0); // 4 bytes unused 
	pos = insertInt(pos, sizeOfBMPHeader+sizeOfDIBHeader); // 4 bytes
	// header complete

	// DIB Header start
	pos = insertInt(pos, sizeOfDIBHeader); // 4 bytes
	pos = insertInt(pos, 2); // Width of the bitmap in pixels
	pos = insertInt(pos, 2); // Height of the bitmap in pixels. 
	pos = insertTwoBytes(pos, 1); // Number of color planes being used
	pos = insertTwoBytes(pos, 24); // 24 bits per pixel
	pos = insertInt(pos, 0); // no pixel array compression used
	pos = insertInt(pos, 16); // 16 bytes, Size of the raw bitmap data (including padding)
	pos = insertInt(pos, 2835); // 13 0B 00 00 	2835 pixels/metre horizontal
	pos = insertInt(pos, 2835); // 13 0B 00 00 	2835 pixels/metre vertical
	pos = insertInt(pos, 0); //	0 colors 	Number of colors in the palette
	pos = insertInt(pos, 0); //	0 important colors 	0 means all colors are important 
	// DIB Header complete

	// Data Start
	pos = insertPixel(pos, 0xFF, 0xFF, 0xFF);
	pos = insertPixel(pos, 0xFF, 0x00, 0x00);
	pos = insertTwoBytes(pos, 0);
	pos = insertPixel(pos, 0x00, 0x00, 0xFF);
	pos = insertPixel(pos, 0xFF, 0xFF, 0x00);
	pos = insertTwoBytes(pos, 0);
	// Data Complete

	*(pos++) = '\0'; 
	fwrite(buffer, sizeOfFile, 1, file);
	printf("SizeofFile: %x", sizeOfFile);
	return 0;

}
