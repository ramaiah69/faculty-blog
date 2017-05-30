<?php
	function filetype_status($type)
	{
		require "connect.php";
		if(strstr($type,'/'))
		{
			$newtype=explode("/",$type);
			$type=$newtype[1];
			$check=mysql_query("select * from file_type where type='$type'");
			return mysql_fetch_array($check)?1:0;
		}else
		{
			 $check=mysql_query("select * from file_type where type='$type'");
			 return mysql_fetch_array($check)?1:0;

		}
	}
	
?>
