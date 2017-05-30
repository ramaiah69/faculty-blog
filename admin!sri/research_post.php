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
	<title>Post a Project</title>
<style>
	
</style>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/notification_style.css">
</head>
<body>

	<center>
	<div>
		<form method="post" class="form" enctype="multipart/form-data"><br>
			
			<h3 class="titl">Post a Research<hr class="hr"></h3>
			
			<input type="text" name="title" placeholder="Title" title="Title of research" required>
			<br><br>
			<select name="area" title="Select research area">
					<option name="type" >Select Research area</option>
					<option name="type" value="Power system Dynamics">Power sytem Dynamics</option>
			</select>
			
			
			<br><br>
			<textarea name="description" rows="5" cols="60" placeholder="Type matter here" title="Add description" required></textarea>
			
			<br><br>
			<input type="file" name="file" title="Add a file or leave alone">
		
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


	if(!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['area']))
	{
		require "../requires/connect.php";
		require "../requires/functions.php";
		
		$title=mysql_real_escape_string($_POST['title']);
		$description=mysql_real_escape_string($_POST['description']);
		$area=mysql_real_escape_string(test_input($_POST['area']));
		date_default_timezone_set("Asia/Calcutta");
		$date=date("Y-m-d");
		$time=date("h:i:sa");
		$ip=$_SERVER['REMOTE_ADDR'];
		$target_dir="../research/";
		$target_file=$target_dir.basename($_FILES["file"]["name"]);
		$filename=basename($_FILES["file"]["name"]);
		//mac
		require "../requires/mac_address.php";
		$mac=mac_address($ip);
		
		require "../requires/file_functions.php";
		$type=basename($_FILES["file"]["type"]);
		$error=0;
		if(!empty($filename))
		{	
				if($status=filetype_status($type))
				{
					if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_file))
					{
						
					}
					else
					{
						echo "not uploaded file";
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
					$error=1;
				}
		}
		if($error==0)
		{
				$r=mysql_query("insert into research (title,description,area,date,time,ip,file,visibility,mac) values ('$title','$description','$area','$date','$time','$ip','$filename','visible','$mac')");
				if($r)
				{
						echo "<script>window.alert('Research article posted successfully')</script>";
					}
					else
					{
						echo "Not";
				}
		}
				
		mysql_close($connection);		
	}
	
}
?>

