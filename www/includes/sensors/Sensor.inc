<?php

class Sensor
{
	protected $dbh;

	public function __construct(&$dbh){
		$this->dbh=$dbh;
	}

	public function measure(){
		return NULL;
	}

	protected function register($description,$type){
		$q = $this->dbh->prepare('SELECT ID FROM SENSORS WHERE DESCRIPTION=:description AND SENSOR_TYPE=:type');
		$q->execute(array(':description'=>$description,':type'=>$type));
		
		if($q->rowCount() == 0){
			$q = $this->dbh->prepare('INSERT INTO SENSORS (DESCRIPTION,SENSOR_TYPE) VALUES (:description,:type)');
			$q->execute(array(':description'=>$description,':type'=>$type));
			return $this->dbh->lastInsertId();
		}		
		else{
			$row = $q->fetch(PDO::FETCH_ASSOC);
			return $row['ID'];
		}
	}

	protected function save(&$values){
                foreach($values as $k => $v){
                        $q = $this->dbh->prepare('INSERT INTO MEASUREMENTS (SENSOR_ID,VALUE) VALUES (:sid,:val)');
                        $q->execute(array(
                                ':sid'   => $k,
                                ':val'   => $v
                        ));
                }

	}
}
