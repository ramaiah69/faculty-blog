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
		<title>Change Sem</title>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/notification_style.css">
	</head>
<body>
	<center>
		<form class="form" method="post"><br>
			<table>
			<tr>
				<h3 class="titl">Change Current Sem<hr class="hr"/></h3>
			</tr>
			<tr>
				<select name="sem" title="Select sem">
					<option name="sem" value="">Select sem</option>
					<option name="sem" value="sem1">SEM1</option>
					<option name="sem" value="sem2">SEM2</option>
					<option name="sem" value="sem3">SUMMER</option>
					<option name="sem" value="sem4">WINTER</option>
				</select>
			</tr>
			<br><br>
			<tr>
				<select name="year" title="Select year">
					<option name="year" value="">Select year</option>
					<?php
						$year=date('Y');
						$ss=$year+2;
						while($year<=$ss)
						{
							echo '<option name="year" value="'.$year.'">'.$year.'</option>';
							$year++;
						}
					?>
				</select>
			</tr>
			<br><br>
			<tr>
				<input type="submit" name="submit"><br><br><br>
			</tr>
			</table>
		</form>
	</center>
</body>
</html>
<?php
	if(isset($_POST['submit']))
	{
		if(!empty($_POST['sem']) && !empty($_POST['year']))
		{
			require "../requires/functions.php";
			//getting details from admin
			$sem=mysql_real_escape_string(test_input($_POST['sem']));
			$year=mysql_real_escape_string(test_input($_POST['year']));
			require "../requires/connect.php";
			
			date_default_timezone_set("Asia/Calcutta");
			$date=date("Y-m-d");
			$time=date("h:i:sa");
			$ip=$_SERVER['REMOTE_ADDR'];
			//getting mac
			require "../requires/mac_address.php";
			$mac=mac_address($ip);
			$query=mysql_query("select * from current_sem");
			$query=mysql_fetch_array($query);
			if(!empty($query['sem']) && !empty($query['year']))
			{
				$array=mysql_query("update current_sem set sem='$sem',year='$year',date='$date',time='$time',ip='$ip',mac='$mac'");
			}
			else
			{
				$array=mysql_query("insert into current_sem (sem,year,date,time,ip,mac) values ('$sem','$year','$date','$time','$ip','$mac')");
			}
			if($array)
			{
				echo "<script>alert('current sem updated');</script>";
			}
			else
			{
				echo "not updated successfully";
			}
		}
		else
		{
			echo 'Fill details without empty';
		}
		
	}
?>
