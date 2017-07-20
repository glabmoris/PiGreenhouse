<?php
	//require_once("../includes/sensors/DS18B20.inc");
	//require_once("../includes/sensors/EZOPH.inc");
        //require_once("../includes/sensors/EZOEC.inc");
	require_once("../includes/sensors/DHT22.inc");
	require_once("../includes/bootstrap.inc");

	$db = init_db();

	// Init sensors
	$sensors = [];
	$sensors[] = new DHT22('DHT22',4,$db);
	

	foreach($sensors as $s){
		$s->measure();
	}
?>
