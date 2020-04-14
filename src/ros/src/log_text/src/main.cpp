#ifndef MAIN_CPP
#define MAIN_CPP

#include <iostream>
#include <fstream>
#include <string>

#include "ros/ros.h"
#include "am2315/Environment.h"


class TextLogger{
	public:
		TextLogger(std::string & filename){
			file.open(filename,std::ios::app|std::ios::ate);
		}

		~TextLogger(){
			file.close();
		}

		void log(const am2315::Environment & env){
			uint64_t timestamp_us = (uint64_t) env.header.stamp.sec*1000000 + (uint64_t)env.header.stamp.nsec/1000;

			file 	<< env.header.frame_id 
				<< " " << timestamp_us 
				<< " " << env.temperature 
				<< " " << env.humidity 
				<< std::endl;
		}

	private:

		std::ofstream file;
};

int main(int argc,char ** argv){
	ros::init(argc, argv, "log-text");

	//FIXME: get from argv
	std::string logFile("/home/ubuntu/log.txt");

	TextLogger log(logFile);

	ros::NodeHandle n;

	ros::Subscriber sub = n.subscribe("environment", 1000, &TextLogger::log,&log);

	ros::spin();

	return 0;
}

#endif
