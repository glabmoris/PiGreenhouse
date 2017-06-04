<?php
	require_once("../includes/sensors/DS18B20.inc");
	require_once("../includes/sensors/EZOPH.inc");
        require_once("../includes/sensors/EZOEC.inc");
	require_once("../includes/bootstrap.inc");

	$db = init_db();

	$gpio_select = 16;
	$serial_port = "/dev/ttyAMA0";

	//Init GPIO
	exec("cd /sys/class/gpio;echo $gpio_select > export;cd gpio$gpio_select;echo out > direction");

	//Init UART
	exec("stty -F $serial_port cs8 9600 ignbrk -brkint -imaxbel -opost -onlcr -isig -icanon -iexten -echo -echoe -echok -echoctl -echoke noflsh -ixon -crtscts");

	//Init sensors
	$temp_sensor = new DS18B20("/sys/bus/w1/devices/28-000006a36d0a/w1_slave");
	$ph_sensor   = new EZOPH($serial_port); //GPIO is used to toggle between the 2
	$ec_sensor   = new EZOEC($serial_port);


	//Get temperature
	$temperature = round($temp_sensor->getTemperature(),1);
	echo "Temperature: " . $temperature . "\n";

	//Get pH
	exec("echo 0 > /sys/class/gpio/gpio$gpio_select/value");
	$ph = round($ph_sensor->getPh($temperature),1);
	echo "pH: " . $ph . "\n";

	//Get EC
	exec("echo 1 > /sys/class/gpio/gpio$gpio_select/value");
	$ec = round($ec_sensor->getEC($temperature) / 1000 ,2);
	echo "EC: " . $ec . "\n";

	$q = $db->prepare('INSERT INTO MEASUREMENTS (PH,EC,TEMPERATURE) VALUES (:ph,:ec,:temp)');
	$q->execute(array(
				':ph'   => $ph,
				':ec'   => $ec,
				':temp' => $temperature
	));
?>
