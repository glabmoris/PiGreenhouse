<?php
	require_once("sensors/DS18B20.inc");
	require_once("sensors/EZOPH.inc");
        require_once("sensors/EZOEC.inc");

	$gpio_select = 16;

	//Init GPIO
	exec("cd /sys/class/gpio;echo $gpio_select > export;cd gpio$gpio_select;echo out > direction");

	//Init sensors
	$temp_sensor = new DS18B20("/sys/bus/w1/devices/28-000006a36d0a/w1_slave");
	$ph_sensor   = new EZOPH("/dev/ttyAMA0"); //GPIO is used to toggle between the 2
	$ec_sensor   = new EZOEC("/dev/ttyAMA0");


	//Get temperature
	$temperature = round($temp_sensor->getTemperature(),1);
	echo "Temperature: " . $temperature . "\n";

	//Get pH
	exec("echo 0 > /sys/class/gpio/gpio$gpio_select/value");
	$ph = round($ph_sensor->getPh(),1);
	echo "pH: " . $ph . "\n";

	//Get EC
	exec("echo 1 > /sys/class/gpio/gpio$gpio_select/value");
	$ec = round($ec_sensor->getEC(),2);
	echo "EC: " . $ec . "\n";

?>
