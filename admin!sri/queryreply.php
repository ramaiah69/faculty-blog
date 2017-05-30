<?php
	//Checking authority
	require "session_check.php";
	if($login_entry_status)	
		{}
	else
		header("location:login.php");
?>
<html>
<head>
	<link rel="shortcut icon" href="../images/rgu.ico">
	<title>Query Reply</title>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/notification_style.css">
<style>
	input,select
	{
		width:50%;
		border:1px solid black;
	}
	
</style>
</head>
<body>
<br>
</body>
</html>
<?php

if(!empty($_GET['id']))
{
	require "../requires/connect.php";
	require "../requires/functions.php";
	$id=mysql_real_escape_string(test_input($_GET['id']));
	$result=mysql_query("select * from problem where id='$id'");
	$ss=mysql_fetch_array($result);
		echo '<center><form method="post" class="form" enctype="multipart/form-data"><br>';
		echo '<h3 class="titl">Query-Reply</h3><hr class="hr"><br>';
		echo '<input class="hidden" type="text"  name="id" value="'.$ss['id'].'" readonly>';
		echo 'Send By:<input class="disabled"  name="send by" value="'.$ss['sendby'].'"placeholder="Send by" title="Problem send by" readonly>';
		echo '<br><br>';
		echo $ss['problem_type'].'<textarea class="disabled" name="matter" rows="5" cols="60" readonly title="Problem type">'.$ss['description'].'</textarea>';
		echo '<br><br>';
		echo 'Reply::';
		echo '<textarea name="reply" rows="5" cols="60" placeholder="Type reply here" title="Enter Reply">'.$ss['reply'].'</textarea>';
		echo '<br><br>';
		echo '<input type="submit" name="newsubmit"><br><br>';
		echo '<br>';
		echo '</form></center>';
}
	
?>
<?php
	if(isset($_POST['newsubmit']))
	{
		if(!empty($_POST['id']) && !empty($_POST['reply']))
		{
			//getting data by post
			$id=mysql_real_escape_string(test_input($_POST['id']));
			$reply=mysql_real_escape_string($_POST['reply']);
			date_default_timezone_set("Asia/Calcutta");
			$date=date("Y-m-d");
			$time=date("H:i:sa");
			$ip=$_SERVER['REMOTE_ADDR'];
			
			//getting mac adress
				require "../requires/mac_address.php";
				$mac=mac_address($ip);
			
			//update data into database
				$r=mysql_query("update problem set reply='$reply',ip_reply='$ip',mac_reply='$mac' where id='$id'");
				if($r)
				{
					echo '<script>window.alert("Reply posted or updated Successfully.")</script>';
					//echo '<script>window.close();</script>';
					
				}
				else
				{
					echo "Not";
				}
		}
	}
?>



