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
		<title>File Type Delete</title>
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
	
	<center>
		<form class="form" method="post" enctype="multipart/form-data">
			<br>
			<h3 class="titl">Delete File type</h3><hr class="hr"><br>
			<input type="text" name="filetype" placeholder="filetype ex- mp3" title="Add file type to delete"required autocomplete="off"><br><br>
			<input type="submit" name="submit" value="submit"><br><br><br>
		</form>
	</center>
</body>
</html>
<?php
	if(isset($_POST['submit']))
	{
		
		if(!empty($_POST['filetype']))
		{
			//getting data by post
			require "../requires/functions.php";
			$filetype=mysql_real_escape_string(test_input($_POST['filetype']));
			require "../requires/connect.php";
			$query=mysql_query("delete from file_type where type='$filetype'");
			if($query)
			{
				echo '<script>alert("Deleted successfully.")</script>';
			}
			else
			{
				echo 'Not updated';
			}
		}
		else
		{
			echo 'Enter valid details without empty';
		}
		mysql_close($connection);
	}
?>
