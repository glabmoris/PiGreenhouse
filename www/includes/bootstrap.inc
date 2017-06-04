<?php

function init_db(){
	try{
		//Open DB handle
		$db = new PDO('mysql:host=localhost;dbname=pigarden;charset=utf8', 'root', 'SuperDatabase42$');
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
		return $db;
	} 
	catch(PDOException $e) {
	    echo $e->getMessage();//Remove or change message in production code
	}

	return FALSE;
}


?>
