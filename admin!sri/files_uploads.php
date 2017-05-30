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
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/notification_style.css">
	</head>
<body>
	<div class="form">
		<center>
	<form method="post" enctype="multipart/form-data" class="">
		<br>
		<h3 class="titl">Add Files in Subject<hr class="hr"></h3>
		<select name="subject" value="" required title="Select subject">
			<option name="subject" value="">Select subject</option>
		<?php
			require "../requires/connect.php";
			$query=mysql_query("select * from current_sem");
			$qq=mysql_fetch_array($query);
			$sem=$qq['sem'];
			$year=$qq['year'];
			$query=mysql_query("select * from subject where sem='$sem' and year='$year'");
			while($data=mysql_fetch_assoc($query))
			{
				echo '<option name="subject" value="'.$data['subject'].'">'.$data['subject'].'</option>';
			}
			mysql_close($connection);
		?>
		</select><br><br>
		<select name="type" value="" title="Select type">
			<option name="type" value="">Select Type</option>
			<option name="type" value="materials">Materials</option>
			<option name="type" value="videos">Videos</option>
		</select><br><br>
		<input type="file" name="file" title="select file"><br><br>
		<input type="submit" name="submit"><br><br>
	</form>
	</center>
	</div>
</body>
</html>
<?php
	if(isset($_POST['submit']))
	{
		if(!empty($_FILES["file"]["name"]) && !empty($_POST['subject']) && $_POST['type'])
		{
			require "../requires/file_functions.php";
			require "../requires/functions.php";
			require "../requires/connect.php";
			$subject=mysql_real_escape_string(test_input($_POST['subject']));
			$sub_type=mysql_real_escape_string(test_input($_POST['type']));
			$target_dir="../subject/$subject/$sub_type/";
			$target_file=$target_dir.basename($_FILES["file"]["name"]);
			$file=basename($_FILES["file"]["name"]);
			$type=basename($_FILES["file"]["type"]);
			if(filetype_status($type))
			{
				if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_file))
				{
					date_default_timezone_set("Asia/Calcutta");
					$date=date("Y-m-d H:i:s");
					
					mysql_query("insert into file (file,date,subject,type) values ('$file','$date','$subject','$sub_type')");
					echo "<script>alert('File was uploaded')</script>";
				}
				else
				{
					echo "not";
				}
			}
			else
			{
				require "../requires/connect.php";
				$array=mysql_query("select * from file_type");
				echo 'File was not uploaded.<br>Only  ';
				while($result=mysql_fetch_assoc($array))
				{
					echo ".".$result['type']."&nbsp;&nbsp;";
				}
				echo "file extensions are allowed";
				mysql_close($connection);
			}
		}
		else
		{
			echo 'attach a file to send';
		}
	}

?>
