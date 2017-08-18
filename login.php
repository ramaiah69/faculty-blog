<?php
	$err="";
	//Checking authority
	require "session_check.php";
	if($login_entry_status)	
		{
			header("location:admin_panel.php");
		}
	else
		{
			require "../requires/connect.php";
			date_default_timezone_set("Asia/Calcutta");
			$date=date("Y-m-d");
			$time=date("h:i:sa");
			$ip=$_SERVER['REMOTE_ADDR'];
			//getting mac
			require "../requires/mac_address.php";
			$mac=mac_address($ip);
			mysql_query("insert into admin_data (ip,mac,date,time,type) values ('$ip','$mac','$date','$time','login')");
			mysql_close($connection);
		}
?>
<html>
	
	<head>
		<link rel="shortcut icon" href="../images/rgu.ico">
		<style>
			
			.title
			{
				color:red;
				font-family:candara;
				font-size:30px;
				font-weight:bold;
			}
			.login input[type=password],.login input[type=text]
			{
				
				padding:8px;
				width:20%;
				min-height:10px;
				min-width:200px;
				
			}
			.login input[type=submit],.login input[type=reset]
			{
				width:10%;
				min-width:125px;
				padding:5px;
				min-height:7px;
			}
			input[type=text]:hover,input[type=password]:hover,input[type=text]:focus,input[type=password]:focus
			{
				border:1px solid #3958DA;
				box-shadow:0px 0px 7px 0px #B4C9E4;
				
			}
			.err
			{
				color:red;
				font-family:century;
			}
			body
			{
				background-image:url("../images/headerbg.png");
			}
		</style>
	</head>
	<body>
		<center><br><br>
			<span class="title">Login</span><br><br>
			<span class="err"><?php  echo $err; ?></span>
			<form method="post" class="login">
				<input type="text" name="userid" placeholder="User Name" class="userid" title="User id" required><br><br>
				<input type="password" name="password" placeholder="Password" class="password" title="Password" required><br><br>
				<input type="submit" value="Submit" name="submit">
				<input type="reset" value="Reset" name="reset">
			</form>
		</center>
	
<?php
	$err="ss";
	if(isset($_POST['submit']))
	{
		if(!empty($_POST['userid']) && !empty($_POST['password']))
		{
			//getting data by post
			require "../requires/functions.php";
			$userid=mysql_real_escape_string(test_input($_POST['userid']));
			$password=mysql_real_escape_string(test_input($_POST['password']));
			require "../requires/connect.php";
			//checing it is a active accout or not
			if($active_account=valid_user($userid))
			{
				$test_array=mysql_query("select * from register where id='$userid' and password=md5('$password')");
				$result=mysql_fetch_array($test_array);
				if(!empty($result['id']) && !empty($result['password']))
				{
					date_default_timezone_set("Asia/Calcutta");
					$ip=$_SERVER['REMOTE_ADDR'];
					//getting mac
						
						$mac=mac_address($ip);
						$time=date("h:i:sa");
						$date=date("Y-m-d");
						mysql_query("insert into admin_data (ip,mac,date,time,type) values('$ip','$mac','$date','$time','admin')");
					require '../requires/session.php';
					$_SESSION['user']=$userid;
					
					
					header("location:admin_panel.php");
					
				}
				else
				{
					echo "<center><span class='err'>Invalid credinals</span></center>";
				}
			}
			else
			{
				echo "<center><span class='err'>Not a valid user</span></center>";
			}
		}
		else
		{
			echo "<center><span class='err'>Please fill details</span></center>";
		}
		mysql_close($connection);
	}

function valid_user($userid)
{
	$array=mysql_query("select * from register where id='$userid'");
	$result=mysql_fetch_array($array);
	return empty($result)?0:1;
}

?>
</body>
</html>
