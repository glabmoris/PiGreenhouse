<?php
require_once("includes/bootstrap.inc");

$db = init_db();

$sql<<<SQL
CREATE TABLE MEASUREMENTS(
 ID BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 mtime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PH REAL NOT NULL,
 EC REAL NOT NULL,
 TEMPERATURE REAL NOT NULL
);
SQL

try{
	$db->exec($sql);
} catch(PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}
?>

