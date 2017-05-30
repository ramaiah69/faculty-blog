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
		<title>Add Subject</title>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/notification_style.css">
	</head>
<body>
	
	<center>
	<div>
		<form class="form" method="post"><br><h3 class="titl">Add Subject<hr class="hr"></h3>
			
			<input type="text" name="subject" placeholder="Subject Name" required title="Enter subject name"><br><br>
			<select name="year" required title="Select year">
				<option name="year" value="">Select Year for subject</option>
				<?php
					$year_now=date('Y');
					$year=$year_now+2;
				
					while($year_now<=$year)
					{
						echo '<option name="year" value="'.$year_now.'">'.$year_now.'</option>';
						$year_now++;
					}
				?>
			</select><br><br>
			<select name="semester" required title="Select semester">
				<option name="semester" value="">Select Semester</option>
				<option name="semester" value="sem1">SEM1</option>
				<option name="semester" value="sem2">SEM2</option>
				<option name="semester" value="summer">SUMMER</option>
				<option name="semester" value="winter">WINTER</option>
			</select><br><br>
			<input type="submit" name="submit"><br><br><br>
			<br>
		</form>
	</div>
	</center>
</body>
</html>
<?php

	if(isset($_POST['submit']))
	{
		if(!empty($_POST['subject']) && !empty($_POST['year']) && !empty($_POST['semester']))
		{
			require "../requires/connect.php";
			require "../requires/functions.php";
			$subject=strtoupper(mysql_real_escape_string(test_input($_POST['subject'])));
			$year=mysql_real_escape_string(test_input($_POST['year']));
			$sem=mysql_real_escape_string(test_input($_POST['semester']));
			$ss=mysql_query("select subject from subject where subject='$subject'");
			$ss=mysql_fetch_array($ss);
			date_default_timezone_set("Asia/Calcutta");
			$date=date("Y-m-d");
			$time=date("h:i:sa");
			$ip=$_SERVER['REMOTE_ADDR'];
			//getting mac
				require "../requires/mac_address.php";
				$mac=mac_address($ip);
			if($ss['subject'])
			{
				$query=mysql_query("update subject set year='$year',sem='$sem',time='$time',date='$date',ip='$ip',mac='$mac' where subject='$subject'");
				if($query)
				echo "<script>alert('Subject updated successfully.');</script>";
				else 
				echo 'not successfully updated';
			}
			else
			{
				$dd=mysql_query("select * from subject where subject='$subject'");
				$dd=mysql_fetch_array($dd);
				$query=mysql_query("insert into subject (subject,year,sem,ip,date,time,mac) values ('$subject','$year','$sem','$ip','$date','$time','$mac')");
				if($query)
				{
					
					if($dd['subject'])
					{
					}
					else
					{
						$dir="../subject/$subject";
						if(is_dir($dir))
						{
						}
						else
						{
							mkdir("../subject/".$subject);
							mkdir("../subject/".$subject."/materials/");
							mkdir("../subject/".$subject."/videos");
							copy("../js/2.php","../subject/".$subject."/index.php");
							copy("../js/1.php","../subject/".$subject."/videos/index.php");
							copy("../js/1.php","../subject/".$subject."/materials/index.php");
						}
					}
					echo "<script>alert('Subject added successfully.');</script>";
				}
				else
				{
					echo "Not added successfully ";
				}
			}
			
			
			mysql_close($connection);
		}
	}
?>
