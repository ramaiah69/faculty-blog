<?php
	$connection=mysql_connect("localhost","root","Sr!n@dh43#");
	if($connection)
	{
		$connection_database=mysql_select_db("project@sri");
		
	}
	else
	{
		echo 'Database connection is failed';
	}
?>
