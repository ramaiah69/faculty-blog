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
	<title>Article Post</title>
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/notification_style.css">
</head>
<body>
	<div class="form">
		<center>
			<br>
			<h3 class="titl">Add a project<hr class="hr"></h3>
			<form method="post" enctype="multipart/form-data">
				<input type="text" name="title" placeholder="title" title="Enter a tile" required><br><br>
				<select name="batch" required title="Select a batch">
					<option name="batch" value="">Slect a Batch</option>
					<option name="batch" value="btech">BTECH</option>
					<option name="batch" value="mtech">MTECH</option>
					<option name="batch" value="phd">PHD</option>
				</select>
				<br><br>
				<select name="year" required title="Select a year">
					<option name="year" value="">Select Year</option>
					<?php
						$year_now=date("Y")-1;;
						$year=$year_now+2;
						while($year_now<=$year)
						{
							echo '<option name="year" value="'.$year_now.'">'.$year_now.'</option>';
							$year_now++;
						}
					?>
				</select>
				<br><br>
				<input type="file" name="file" required title="Add a file or leave alone"><br><br>
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
		if(!empty($_POST['title']) && !empty($_POST['batch']) && !empty($_POST['year']))
		{
			//getting data by post
			require "../requires/functions.php";
			require "../requires/connect.php";
			$title=mysql_real_escape_string(test_input($_POST['title']));
			$batch=mysql_real_escape_string(test_input($_POST['batch']));
			$year=mysql_real_escape_string(test_input($_POST['year']));
			date_default_timezone_set("Asia/Calcutta");
			$date=date("Y-m-d");
			$time=date("H:i:s");
			$ip=$_SERVER['REMOTE_ADDR'];
			
			$filename=basename($_FILES["file"]["name"]);
			//mac address
				require "../requires/mac_address.php";
				$mac=mac_address($ip);
			//file uploading
			if(!empty($filename))
			{	
				$target_dir="../project/";
				$target_file=$target_dir.basename($_FILES["file"]["name"]);
				require "../requires/file_functions.php";
				$filetype=basename($_FILES["file"]["type"]);
				//checking file type
					if($status=filetype_status($filetype))
					{
						if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_file))
						{
							$s=mysql_query("insert into project (title,batch,year,file,date,time,ip,mac)values ('$title','$batch','$year','$filename','$date','$time','$ip','$mac')");
							if($s)
							{
								echo '<script>alert("Project added successfully");</script>';
							}
						}
						else
						{
							
							echo "not uploaded";
						}
					}
					else
					{
						$array=mysql_query("select * from file_type");
						echo 'File was not uploaded.<br>Only  ';
						while($result=mysql_fetch_assoc($array))
						{
							echo ".".$result['type']."&nbsp;&nbsp;";
						}
						echo "file extensions are allowed";
						
					}
			}
			else
			{
				echo 'please fill details without empty';
			}
			mysql_close($connection);
		}
		else
		{
			echo 'please fill details without empty';
		}
	}
?>

