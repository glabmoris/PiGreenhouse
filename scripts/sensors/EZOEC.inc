<?php

require_once("EcSensor.inc");

class EZOEC extends EcSensor
{
	private $devicePath;

	public function __construct($path) {
		$this->devicePath = $path;	
	}

	public function getEC(){
                ini_set("auto_detect_line_endings", true); //The EZO board uses CR line endings

                if($file = fopen($this->devicePath, "rw+")){
			fputs($file,"R\r");
                        $ec = floatval(fgets($file));
                        fclose($file);

                        return $ec;
                }
                else{
                        //TODO whine
                }
	}

}
