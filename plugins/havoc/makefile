GPP = g++
GCC = gcc
OUTPUT = "bin/havoc.so"
COMPILER_FLAGS = -std=gnu++11 -c -m32 -fPIC -O3 -DLINUX -w -I./include/ -I./include/SDK/amx/
LIBRARIES = ./lib/*.a -lrt
CRYPTOPP_SRC_DIR = ./include/cryptopp

all: cryptlib havoc clean

cryptlib:
	$(MAKE) -C $(CRYPTOPP_SRC_DIR) static
	mkdir -p lib
	cp $(CRYPTOPP_SRC_DIR)/libcryptopp.a ./lib

havoc:
	$(GCC) $(COMPILER_FLAGS) ./include/SDK/amx/*.c
	$(GPP) $(COMPILER_FLAGS) ./include/SDK/*.cpp
	$(GPP) $(COMPILER_FLAGS) ./src/*.cpp
	mkdir -p bin
	$(GPP) -m32 -O2 -fshort-wchar -shared -o $(OUTPUT) *.o $(LIBRARIES)
	
clean:
	rm -f *.o
