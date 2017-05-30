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
		<title>Edit Subject</title>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/notification_style.css">
		<style>
			input,select
			{
				width:50%;
			}
			
		</style>
	</head>
<body>
	<div>
		<?php
		require "../requires/connect.php";
		require "../requires/functions.php";
		if(!empty($_GET['subject']))
		{
			$subject=mysql_real_escape_string(test_input($_GET['subject']));
			$result=mysql_query("select * from subject where subject='$subject'");
			$ss=mysql_fetch_array($result);
				echo '<center><form method="post" class="form" enctype="multipart/form-data"><br>';
				echo '<h3 class="titl">Rename</h3><hr class="hr"><br>';
				echo '<input type="text" name="subject" value="'.$ss['subject'].'" readonly class="disabled" title="Subject to be rename"><br><br>';
				echo '<input type="text" name="new_sub" placeholder="New name for subject" title="Enter new name for subject">';
				echo '<br><br>';
				echo '<input type="submit" name="newsubmit"><br><br>';
				echo '<br>';
				echo '</form></center>';
		}
			
		?>
	</div>
</body>
</html>
<?php
	if(isset($_POST['newsubmit']))
	{
		if(!empty($_POST['subject']) && !empty($_POST['new_sub']))
		{
			//getting data by post
				$subject=mysql_real_escape_string(test_input($_POST['subject']));
				$new_sub=strtoupper(mysql_real_escape_string(test_input($_POST['new_sub'])));
				date_default_timezone_set("Asia/Calcutta");
				$date=date("Y-m-d");
				$time=date("H:i:sa");
				$ip=$_SERVER['REMOTE_ADDR'];
			
			//getting mac adress
				require "../requires/mac_address.php";
				$mac=mac_address($ip);
			
			//update data into database
				
				
				$s=rename("../subject/$subject","../subject/$new_sub");
				if($s)
				{
					$r=mysql_query("update subject set subject='$new_sub',date='$date',time='$time',ip='$ip',mac='$mac' where subject='$subject'");
					echo '<script>window.alert("Subject Renamed")</script>';	
				}
				else
				{
					echo "Not renamed";
				}
		}
	}

?>

