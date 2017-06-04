<?php

require_once("TemperatureSensor.inc");

class DS18B20 extends TemperatureSensor
{
	private $oneWirePath;

	private $nbRetries = 5;

	public function __construct($path) {
		$this->oneWirePath = $path;	
	}

	public function getTemperature(){
		for($i=0; $i<$this->nbRetries; $i++){
			$temperature = array();
			$raw_output = `cat $this->oneWirePath`;
			//echo $raw_output;
			
			if(preg_match('/[a-z0-9]{2} [a-z0-9]{2} [a-z0-9]{2} [a-z0-9]{2} [a-z0-9]{2} [a-z0-9]{2} [a-z0-9]{2} [a-z0-9]{2} [a-z0-9]{2} : crc=[a-z0-9]{2} YES\n[a-z0-9]{2} [a-z0-9]{2} [a-z0-9]{2} [a-z0-9]{2} [a-z0-9]{2} [a-z0-9]{2} [a-z0-9]{2} [a-z0-9]{2} [a-z0-9]{2} t=(\d+)/i',$raw_output,$temperature)){
				return floatval($temperature[1]) / 1000;
			}
		}
	
		return 42;
	}

}
