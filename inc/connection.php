<?php

	//$connection = mysql_connect(dbserver,dbuser,dbpass,dbname);
	$connection = mysqli_connect('localhost','root','','blockbusterb');
	


	//We can find the connection is successful or not like below
	#"mysqli_connect_errno()" function gives the error number and "mysqli_connect_error()" gives the error
	# the if statement executes only the "mysqli_connect_errno()" fuction gives the true value

	if(mysqli_connect_errno()){
		die('Database Connection Error : '.mysqli_connect_error());
	}else{
		//echo "Database Connection Successful";
	}


	// We should include this connection in every page we want to access the database
	# Hense this file is save on the inc folder and included to the file by "include_once()" or "require_once()" functions. 

?>