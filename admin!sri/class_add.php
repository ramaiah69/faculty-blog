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
		<title>Assignment Post</title>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/notification_style.css">
		<script>
			function conform()
			{
				if(confirm("Are you sure")==true)
				{
					window.location("assignment_post.php");
				}
			}
		</script>
	</head>
<body>
	<div class="form">
		<center>
			<br>
			<h3 class="titl">Add Class<hr class="hr"></h3>
			<form method="post" enctype="multipart/form-data">
				<input type="text" name="class" placeholder="Class"><br><br>
				<select name="year" title="Select year of current sem">
					<option name="class" value="">Select Year of Current sem</option>
					<?php
						require "../requires/connect.php";
						$year_now=date("Y");
						$year=$year_now+2;
						while($year_now<=$year)
						{
							echo '<option name="year" value="'.$year_now.'">'.$year_now.'</option>';
							$year_now++;
						}
					?>
				</select><br><br>
				<select name="sem" value="" title="Select sem">
					<option name="sem" value="">Select Sem</option>
					<option name="sem" value="sem1">SEM1</option>
					<option name="sem" value="sem2">SEM2</option>
					<option name="sem" value="summer">SUMMER</option>
					<option name="sem" value="winter">WINTER</option>
				</select><br><br>
				
				<input type="submit" name="submit">
			</form>
			<br><br>
		</center>
	</div>
</body>
</html>
<?php
	if(isset($_POST['submit']))
	{
		if(!empty($_POST['class']) && !empty($_POST['year']) && !empty($_POST['sem']))
		{
			require "../requires/functions.php";
			$class=strtoupper(mysql_real_escape_string(test_input($_POST['class'])));
			$sem=mysql_real_escape_string(test_input($_POST['sem']));
			$year=mysql_real_escape_string(test_input($_POST['year']));
			date_default_timezone_set("Asia/Calcutta");
			$date=date("Y-m-d");
			$time=date("h:i:sa");
			$ip=$_SERVER['REMOTE_ADDR'];
			$mac=false;
			//getting mac
				require "../requires/mac_address.php";
				$mac=mac_address($ip);
			$clss=strtoupper($class);
			$query=mysql_query("select * from class where class='$class'");
			$query=mysql_fetch_array($query);
			if($query)
			{
				$s=mysql_query("update class set class='$class',sem='$sem',year='$year',date='$date',time='$time',ip='$ip',mac='$mac'");
			}else
			{
				$s=mysql_query("insert into class (class,sem,year,date,time,ip,mac)values ('$class','$sem','$year','$date','$time','$ip','$mac')");
			}
			if($s)
			{
				echo '<script>';
				echo 'alert("Class Added successfully");</script>';
			}
			else
			{
				echo 'not uploaded';
			}
			
		}
		else
		{
			echo 'Fill details without empty';
		}
	}
?>
