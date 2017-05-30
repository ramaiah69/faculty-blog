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
		<title>Add Software</title>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/notification_style.css">
	</head>
<body>
	
	<div class="form">
		<center>
			<br>
			<h3 class="titl">Add Software<hr class="hr"></h3>
			<form method="post" enctype="multipart/form-data">
				
				<input type="file" name="file" required title="Add a software"><br><br>
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
		require "../requires/file_functions.php";
		$target_dir="../software/";
		$target_file=$target_dir.basename($_FILES["file"]["name"]);
		$type=$_FILES["file"]["type"];
		if(filetype_status($type))
		{
			if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_file))
			{
				
				echo "<script>alert('File Uploaded Successfully.');</script>";
			}
			else
			{
				echo "not uploaded";
			}
		}
		else
		{
			require "../requires/connect.php";
			$array=mysql_query("select * from file_type");
			echo 'File was not uploaded.Your file is '.$type.'.<br>Only  ';
			while($result=mysql_fetch_assoc($array))
			{
				echo ".".$result['type']."&nbsp;&nbsp;";
			}
			echo "file extensions are allowed";
			mysql_close($connection);
		}
	}
?>
