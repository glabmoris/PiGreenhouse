<?php

require_once("PhSensor.inc");

class EZOPH extends PhSensor
{
	private $devicePath;

	public function __construct($path) {
		$this->devicePath = $path;	
	}

	public function getPh($temperature){
		ini_set("auto_detect_line_endings", true); //The EZO board uses CR line endings

		if($file = fopen($this->devicePath, "r+")){
			//Temperature compensation
			fwrite($file,"T,$temperature\r");
			fgets($file);

			//Read pH
			fwrite($file,"R\r");
			$ph = floatval(fgets($file));
			fclose($file);

			return $ph;
		}
		else{
			echo "Can't open file $this->devicePath\n";
		}
	}
}
