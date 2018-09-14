target: encoder.c
	gcc encoder.c -g -o encoder

all: target decoder

decoder: decoder.c
	gcc decoder.c -g -o decoder

.PHONY: clean
clean:
	$(RM) encoder decoder
