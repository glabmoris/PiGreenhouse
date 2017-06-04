<?php

require_once("EcSensor.inc");

class EZOEC extends EcSensor
{
	private $devicePath;

	public function __construct($path) {
		$this->devicePath = $path;	
	}

	public function getEC($temperature){
		ini_set("auto_detect_line_endings", true);
                
		if($file = fopen($this->devicePath, "rw+")){

			//Temp compensation
			fputs($file,"T,$temperature\r");
			fgets($file);

			//Read EC
			fputs($file,"R\r");
			$line = fgets($file);
                        $ec = floatval($line);
                        fclose($file);

                        return $ec;
                }
                else{
			echo "Can't open file $this->devicePath\n";
                }
	}

}
