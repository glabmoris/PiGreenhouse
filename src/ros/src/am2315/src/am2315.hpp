#ifndef AM2315_HPP
#define AM2315_HPP

#include <iostream>
#include <string>
#include <exception>

#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <sys/ioctl.h>
#include <cstdio>
#include <cstdlib>
#include <cstdint>
#include <unistd.h>
#include <linux/i2c-dev.h>

#include "am2315/Environment.h"

#define I2C_ADDRESS 0x5c

//Function codes
#define READ_REGISTERS  0x03
#define WRITE_REGISTERS 0x10

//Registers
#define RH_HI   0x00
#define RH_LO   0x01
#define TEMP_HI 0x02
#define TEMP_LO 0x03

#pragma pack(1)
typedef struct{
	uint8_t  functionCode;
	uint8_t  nBytes;
	uint8_t  humidityHi;
	uint8_t  humidityLo;
	uint8_t  tempHi;
	uint8_t  tempLo;
	uint16_t crc;
} tempHumidityReply;
#pragma pack()


class am2315Sensor{
	public:
		am2315Sensor(std::string & i2cBusPath,std::string & zoneId) : i2cBusPath(i2cBusPath),zoneId(zoneId){

		}

		~am2315Sensor(){
			if(file != -1){
				close(file);
			}
		}

		void init(){
			if ((file = open(i2cBusPath.c_str(), O_RDWR)) != -1) {
		                int addr = I2C_ADDRESS;

                		if(ioctl(file, I2C_SLAVE, addr) != -1){
					//ok
				}
				else{
					perror("ioctl");
					throw std::runtime_error("Error while setting I2C slave address");
				}
			}
			else{
		                perror("open");
				throw std::runtime_error("Error while opening I2C bus");
			}
		}

		bool read(am2315::Environment & env){
	                unsigned char tempHumidityRequest[] = {READ_REGISTERS,RH_HI,4};
                        tempHumidityReply reply;
                        int nBytes = 0;

                        //wake up the sensor from sleep mode
                        do{
                                nBytes = write(file,tempHumidityRequest,3);
                        }
                        while(nBytes != 3 );

                        //Let the sensor process the request
                        usleep(2000);

                        //read reply
                        if((nBytes = ::read(file,&reply,sizeof(tempHumidityReply)))==sizeof(tempHumidityReply)){

        	                env.header.stamp=ros::Time::now();
                        	env.header.frame_id=zoneId;

                                //process sensor data
                                env.humidity = (double) (((int)reply.humidityHi * (int)256) + (int)reply.humidityLo) / (double) 10.0;
                                env.temperature = (double) (((int)reply.tempHi * (int)256) + (int)reply.tempLo) / (double) 10.0;

				return true;
                        }
                        else{
                                printf("Error while reading temperature/humidity: %d bytes\n",nBytes);
                        }

			return false;
		}

	private:

		int file = -1;
		std::string i2cBusPath;
		std::string zoneId;
};


#endif
