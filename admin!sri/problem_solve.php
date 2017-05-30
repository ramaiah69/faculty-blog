<?php
	//Checking authority
	require "session_check.php";
	if($login_entry_status)	
		{}
	else
		header("location:login.php");
	if(!empty($_GET['id']))
	{
		require "../requires/functions.php";
		require "../requires/connect.php";
		$id=mysql_real_escape_string(test_input($_GET['id']));
		
		$query=mysql_query("update problem set status='solved' where id='$id'");
		if($query)echo 'ok';
		mysql_close($connection);
	}
	else
	{
		echo 'NO';
	}
?>
