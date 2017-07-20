<?php
require_once("includes/bootstrap.inc");

$db = init_db();

$sql = <<<SQL
CREATE TABLE SENSORS(
 ID BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
 DESCRIPTION VARCHAR(255) NOT NULL,
 SENSOR_TYPE VARCHAR(255) NOT NULL
);
SQL;

try{
	$db->exec($sql);
} catch(PDOException $e) {
	echo $e->getMessage();//Remove or change message in production code
}

$sql = <<<SQL
CREATE TABLE MEASUREMENTS(
 ID BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
 VALUE DOUBLE NOT NULL,
 mtime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 SENSOR_ID BIGINT(20) UNSIGNED NOT NULL,
 INDEX FK_SENSORS_idx (SENSOR_ID ASC),
 CONSTRAINT FK_SENSORS FOREIGN KEY (SENSOR_ID)
    REFERENCES SENSORS (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);
SQL;

try{
        $db->exec($sql);
} catch(PDOException $e) {
        echo $e->getMessage();//Remove or change message in production code
}
