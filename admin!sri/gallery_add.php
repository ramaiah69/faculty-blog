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
		<title>Add Image in Gallery</title>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/notification_style.css">
	</head>
<body>
	
	<div class="form">
		<center>
			<br>
			<h3 class="titl">Add image in Gallery<hr class="hr"></h3>
			<form method="post" enctype="multipart/form-data">
				<input type="text" name="description" placeholder="Description about image" required title="Description about image"><br><br>
				<input type="file" name="file" required title="Insert a file"><br><br>
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
		$target_dir="../img/";
		require "../requires/functions.php";
		$description=mysql_real_escape_string(test_input($_POST['description']));
		$target_file=$target_dir.basename($_FILES["file"]["name"]);
		$filename=basename($_FILES["file"]["name"]);
		$type=$_FILES["file"]["type"];
		if(filetype_status($type))
		{
			if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_file))
			{
				require "../requires/connect.php";
				$r=mysql_query("insert into gallery (file,description) values ('$filename','$description')");
				if($r)
					echo "<script>alert('Image upload Successfully.');</script>";
				else
				echo 'nopt';
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

