<?php

require_once('Sensor.inc');

class DHT22 extends Sensor{
	private $pin;

	//DHT is actually 2 sensors in 1

	private $db_id_temperature;
	private $db_id_humidity;

	public function __construct($description,$pin,&$dbh){
		$this->pin=$pin;
		$this->dbh=$dbh;

                parent::__construct($dbh);

		$this->db_id_temperature = $this->register($description,'Temperature');
		$this->db_id_humidity    = $this->register($description,'Humidity');
	}

	public function measure(){
		//TODO
		$vals[$this->db_id_temperature]=42;
		$vals[$this->db_id_humidity]=22;

		$this->save($vals);
	}
}
