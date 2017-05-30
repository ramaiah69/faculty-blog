<?php
	//Checking authority
	require "session_check.php";
	if($login_entry_status)	
		{}
	else
		header("location:login.php");
	if(!empty($_GET['title']))
	{
		require "../requires/connect.php";
		require "../requires/functions.php";
		$title=mysql_real_escape_string(test_input($_GET['title']));
		{
			
			$r=mysql_query("select subject from assignment where title='$title'");
			$row=mysql_fetch_array($r);
			echo $row['subject'];
		}
		mysql_close($connection);
	}
?>
