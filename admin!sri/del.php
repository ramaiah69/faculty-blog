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
		$delete=1;
		if($type=='notification')
		{
			$query=mysql_query("select * from notification where id='$id'");
			$query=mysql_fetch_array($query);
			$filename=$query['file'];
			if(!empty($filename))
				$delete=unlink("../upload/$filename");
			if($delete)
				$r=mysql_query("delete from notification where id='$id'");
		}
		else if($type=='article')
		{
			$query=mysql_query("select * from article where id='$id'");
			$query=mysql_fetch_array($query);
			$filename=$query['file'];
			if(!empty($filename))
				$delete=unlink("../article/$filename");
			if($delete)
				$r=mysql_query("delete from article where id='$id'");
		}
		else if($type=='project')
		{
			$query=mysql_query("select * from project where id='$id'");
			$query=mysql_fetch_array($query);
			$filename=$query['file'];
			if(!empty($filename))
				$delete=unlink("../project/$filename");
			if($delete)
				$r=mysql_query("delete from project where id='$id'");
		}
		else if($type=='assignment')
		{
			$query=mysql_query("select * from assignment where id='$id'");
			$query=mysql_fetch_array($query);
			$filename=$query['file'];
			$delete=unlink("../assignment/$filename");
			if($delete)
				$r=mysql_query("delete from assignment where id='$id'");
			
		}
		else if($type=='research')
		{
			$query=mysql_query("select * from research where id='$id'");
			$query=mysql_fetch_array($query);
			$filename=$query['file'];
			if(!empty($filename))
				$delete=unlink("../research/$filename");
			if($delete)
			$r=mysql_query("delete from research where id='$id'");
		}
		else if($type=='result')
		{
			$query=mysql_query("select * from result where id='$id'");
			$query=mysql_fetch_array($query);
			$filename=$query['file'];
			$delete=unlink("../result/$filename");
			if($delete)
			$r=mysql_query("delete from result where id='$id'");
		}
		
		else if($type=='query')
		{
			$r=mysql_query("delete from problem where id='$id'");
		}
		else if($type=='subject')
		{
			$r=mysql_query("delete from subject where sid='$id'");
		}
		else if($type=='gallery')
		{
			$query=mysql_query("select * from gallery where id='$id'");
			$query=mysql_fetch_array($query);
			$filename=$query['file'];
			$delete=unlink("../img/$filename");
			if($delete)
				$r=mysql_query("delete from gallery where id='$id'");
		}
		else if($type=='type')
		{
			$r=mysql_query("delete from file_type where type='$type'");
		}
		else if($type=='btech')
		{
			$year=mysql_real_escape_string(test_input($_GET['year']));
			if(!empty($year))
				$r=mysql_query("delete from btech where id='$id' and year='$year'");
		}
		else if($type=='mtech')
		{
			$year=mysql_real_escape_string(test_input($_GET['year']));
			if(!empty($year))
				$r=mysql_query("delete from mtech where id='$id' and year='$year'");
		}
		else if($type=='phd')
		{
			$year=mysql_real_escape_string(test_input($_GET['year']));
			if(!empty($year))
				$r=mysql_query("delete from phd where id='$id' and year='$year'");
		}
		else
		{
			echo '<script>alert("not hided")</script>';
		}
		mysql_close($connection);
	}
?>
