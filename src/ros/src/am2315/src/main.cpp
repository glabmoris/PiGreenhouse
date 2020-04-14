#ifndef MAIN_CPP
#define MAIN_CPP

#include "ros/ros.h"
#include "std_msgs/String.h"

#include "am2315.hpp"


int main(int argc,char ** argv){
	ros::init(argc, argv, "am2315_node");

	std::string i2cBus("/dev/i2c-1");
	std::string zoneId("Greenhouse");

	am2315Sensor s(i2cBus,zoneId);

	try{
		ros::NodeHandle n;
		ros::Publisher environmentTopic = n.advertise<am2315::Environment>("environment", 1000);
		ros::Rate loop_rate((double)1/(double)60);

		s.init();

		uint32_t sequentialNumber;

		while(ros::ok()){
			am2315::Environment env;

			env.header.seq  =sequentialNumber;

			s.read(env);

			environmentTopic.publish(env);

			ros::spinOnce();
			loop_rate.sleep();
			sequentialNumber++;
		}
	}
	catch(std::exception & e){
		std::cerr << e.what() << std::endl;
	}
}

#endif
