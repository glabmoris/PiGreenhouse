<?php

require_once("PhSensor.inc");

class EZOPH extends PhSensor
{
	private $devicePath;

	public function __construct($path) {
		$this->devicePath = $path;	
	}

	public function getPh(){
		ini_set("auto_detect_line_endings", true); //The EZO board uses CR line endings

		if($file = fopen($this->devicePath, "rw+")){
			fputs($file,"R\r");
			$ph = floatval(fgets($file));
			fclose($file);

			return $ph;
		}
		else{
			//TODO whine
		}
	}
}
