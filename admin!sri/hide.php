<?php
	//Checking authority
	require "session_check.php";
	if($login_entry_status)	
		{}
	else
		header("location:login.php");
	if(!empty($_GET['id']) && !empty($_GET['type']))
	{
		
		require "../requires/functions.php";
		require "../requires/connect.php";
		$type=mysql_real_escape_string(test_input($_GET['type']));
		$id=mysql_real_escape_string(test_input($_GET['id']));
		echo $type;
		if(strlen($type)>1)
		{
			
			$r=mysql_query("update $type set visibility='hidden' where id='$id'");
		}
		else
		{
			echo '<script>alert("not hided")</script>';
		}
		mysql_close($connection);
	}
?>
