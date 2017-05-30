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
		<title>Edit student details</title>
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
		if(!empty($_GET['id']) && !empty($_GET['type']))
		{
			$id=mysql_real_escape_string(test_input($_GET['id']));
			$type=mysql_real_escape_string(test_input($_GET['type']));
			$result=mysql_query("select * from $type where id='$id'");
			$ss=mysql_fetch_array($result);
				echo '<center><form method="post" class="form" enctype="multipart/form-data"><br>';
				echo '<h3 class="titl">Edit Students</h3><hr class="hr"><br>';
				echo '<input type="text" name="id" value="'.$ss['id'].'" placeholder="User id" title="User id of student" class="disabled" ><br><br>';
				echo '<input type="text" name="name" value="'.$ss['name'].'"placeholder="Name" title="Name of student">';
				echo '<br><br>';
				echo '<select name="year" required title="Year ">';
					require "../requires/connect.php";
					echo '<option name="year" value="'.$ss['year'].'">'.$ss['year'].'</option>';
					date_default_timezone_set("Asia/Calcutta");
					$year_now=1+date("Y");
					$year_b=$year_now-3;
					while($year_b<$year_now)
					{
						echo '<option name="year" value="'.$year_b.'">'.$year_b.'</option>';
						$year_b++;
					}
				echo "</select><br><br>";
				/*
				echo '<select name="batch" required title="Batch of the student">';
				echo '<option name="batch" value="'.$ss['sem'].'">'.$ss['sem'].'</option>';
				echo '<option name="batch" value="btech">BTECH</option>';
				echo '<option name="batch" value="mtech">MTECH</option>';
				echo '<option name="batch" value="phd">PHD</option>';
				echo '</select>';
				echo "<br><br> ";
				*/
				echo '<input type="submit" name="submit"><br><br>';
				echo '<br>';
				echo '</form></center>';
				mysql_close($connection);
		}
			
		?>
	</div>
</body>
</html>
<?php
	if(isset($_POST['submit']))
	{
		if(!empty($_POST['id']) && !empty($_POST['name']) && !empty($_POST['year']))
		{
			//getting data by post
				require "../requires/connect.php";
				$id=mysql_real_escape_string(test_input($_POST['id']));
				$name=mysql_real_escape_string($_POST['name']);
				$year=mysql_real_escape_string($_POST['year']);
				date_default_timezone_set("Asia/Calcutta");
				$date=date("Y-m-d");
				$time=date("H:i:sa");
				$ip=$_SERVER['REMOTE_ADDR'];
			
			//getting mac adress
				require "../requires/mac_address.php";
				$mac=mac_address($ip);
			
			//inserting data into database
				$r=mysql_query("update $type set name='$name',year='$year',time='$time',date='$date',ip='$ip',mac='$mac' where id='$id'");
				if($r)
				{
					echo '<script>window.alert("Details Updated")</script>';	
				}
				else
				{
					echo "Not";
				}
		}
	}

?>

