<?php 
//Create db connection
 	$db_connect = mysql_connect("mysql.mediawig.com","mediawig","m3d14w1g");
  	if(!$db_connect){
		die("Database connectioin failed: " . mysql_error());
	}
//Select a db
	$db_select = mysql_select_db("mediawig",$db_connect);
	if(!$db_select){
		die("Database connection failed: ". mysql_error());
	}
?>






<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Basic</title>
</head>
<body>
	<?php
	//Perform query
	$result = mysql_query("SELECT * FROM tblContentClass", $db_connect);
	if (!result){
		die("Database query failed: ". mysql_error());
	}
	//Use returned data
	while($row = mysql_fetch_array($result)){
		echo $row[1]." ".$row[2]."<br/>";
	}
	
	?>
</body>
</html>

<?php
// close conection
 mysql_close($db_connect);
?>