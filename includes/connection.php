<?php require('/home/dhford1/mediawigincludes/constants.php'); 
//Create db connection
 	$db_connect = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
  	if(!$db_connect){
		die('Database connectioin failed: ' . mysql_error());
	}
	global $db_connect;
//Select a db
	$db_select = mysql_select_db(DB_NAME,$db_connect);
	if(!$db_select){
		die('Database connection failed: '. mysql_error());
	}
?>
