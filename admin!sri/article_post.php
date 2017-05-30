<?php
	//Checking authority
	require "session_check.php";
	if($login_entry_status)	
		{}
	else
		header("location:login.php");
?>
<html lang="en-us">
	
	<head >
		<link rel="shortcut icon" href="../images/rgu.ico">
		<meta charset="utf-8">
		<title>Post Notification</title>
		<style>
			
		</style>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/notification_style.css">
	</head>
<body>
	<center>
	<div>
		<form method="post" class="form" enctype="multipart/form-data"><br>
			
			<h3 class="titl">Post a Publication<hr class="hr"></h3>
			
			<input type="text" name="title" placeholder="Title" required title="Title of article">
			<br><br>
			<input type="number" name="year" placeholder="Published Year" title="Enter published year"required>
			<br><br>
			<select name="type" title="Select type">
				<option name="type" value="">Select type</option>
				<option name="type" value="journal">Journal</option>
				<option name="type" value="conference">Conference</option>
			</select>
			<br><br>
			<textarea name="description" rows="5" cols="60" placeholder="Type matter here" type="text" required title="Enter description"></textarea>
			
			<br><br>
			<input type="file" name="file" title="Add a file">
		
			<br><br>
			<input type="submit" name="submit"><br><br>
			
			<br>
		
		</form>
		</div>
		</center>
</body>
</html>
<?php
if(isset($_POST['submit']))
{


	if(!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['year']) && !empty($_POST['type']))
	{
		require "../requires/connect.php";
		require "../requires/functions.php";
		$year=mysql_real_escape_string(test_input($_POST['year']));
		$title=mysql_real_escape_string($_POST['title']);
		$description=mysql_real_escape_string($_POST['description']);
		$type=mysql_real_escape_string(test_input($_POST['type']));
		date_default_timezone_set("Asia/Calcutta");
		$date=date("Y-m-d");
		$time=date("h:i:sa");
		$ip=$_SERVER['REMOTE_ADDR'];
		$filename=basename($_FILES["file"]["name"]);
		//getting mac address
			require "../requires/mac_address.php";
			$mac=mac_address($ip);
		
		$error=0;
		if(!empty($filename))
		{	
			$target_dir="../article/";
			$target_file=$target_dir.basename($_FILES["file"]["name"]);
			require "../requires/file_functions.php";
			$filetype=basename($_FILES["file"]["type"]);
				if(filetype_status($filetype))
				{
					if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_file))
					{
						
					}
					else
					{
						echo "not";
						$error=1;
					}
				}
				else
				{
					$array=mysql_query("select * from file_type");
					echo 'File was not uploaded.'.$filetype.'<br>Only  ';
					while($result=mysql_fetch_assoc($array))
					{
						echo $result['type']."&nbsp;&nbsp;";
					}
					echo "file extensions are allowed";
					$error=1;
				}
		}
		if($error==0)
		{
				$r=mysql_query("insert into article (title,description,published_year,type,date,time,ip,file,visibility,mac) values ('$title','$description','$year','$type','$date','$time','$ip','$filename','visible','$mac')");
				if($r)
				{
						echo "<script>window.alert('Article posted successfully')</script>";
				}
				else
					{
						echo "Not";
				}
		}
				
		mysql_close($connection);		
	}
	else
	{
		echo 'Fill details without empty';
	}
}
?>
