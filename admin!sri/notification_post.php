
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
	<title>Post Notification</title>
<style>
	input,select
	{
		width:50%;
	}
</style>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/notification_style.css">
<style>
	body{background-color:#CACDD4}
</style>
</head>
<body >

	<center>
	<div>
		<form method="post" class="form" enctype="multipart/form-data"><br>
			
			<h3 class="titl">Post a Notification<hr class="hr"></h3>
			
			<input type="text" name="title" placeholder="Title" required title="Enter a title">
			
			<br><br>
			<select name="subject" required>
				<option name="subject" value="" title="Select a subject">Select Subject</option>
				<?php
					require "../requires/connect.php";
					$array=mysql_query("select * from current_sem");
					$data=mysql_fetch_array($array);
					$sem=$data['sem'];
					$year=$data['year'];
					
					$array=mysql_query("select * from subject where sem='$sem' and year='$year'");
					while($data=mysql_fetch_assoc($array))
					{
						echo '<option name="subject" value="'.$data['subject'].'">'.$data['subject'].'</option>';
					}
					
				?>
			</select>
			
			<br><br>
			<select name="class" value="" title="Select a class">
				<option name="class" value="">Select Class</option>
				<?php
					$array=mysql_query("select * from class where sem='$sem' and year='$year'");
					while($data=mysql_fetch_assoc($array))
					{
						echo '<option name="class" value="'.$data['class'].'">'.$data['class'].'</option>';
					}
					echo '<option name="class" value="All">All</option>';
					
				?>
			</select>
			
			<br><br>
			<select name="class1" value="" title="Select another class">
				<option name="class1" value="">Select Class</option>
				<?php
					$array=mysql_query("select * from class where sem='$sem' and year='$year'");
					while($data=mysql_fetch_assoc($array))
					{
						echo '<option name="class1" value="'.$data['class'].'">'.$data['class'].'</option>';
					}
					
				?>
			</select><br><br>
			<select name="class2" value="" title="Select another class">
				<option name="class2" value="">Select Class</option>
				<?php
					$array=mysql_query("select * from class where sem='$sem' and year='$year'");
					while($data=mysql_fetch_assoc($array))
					{
						echo '<option name="class2" value="'.$data['class'].'">'.$data['class'].'</option>';
					}
					mysql_close($connection);
				?>
			</select><br><br>
			<textarea name="matter" rows="5" cols="60" placeholder="Type matter here" required title="Enter description"></textarea>
			
			<br><br>
			<input type="file" name="file">
			
			<br><br>
			<input type="submit" name="submit" onClick="post_content('notification')" value="submit"><br><br>
			
			<br>
			
		</form>
		</div>
		</center>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
	if(!empty($_POST['title']) && !empty($_POST['matter']) && !empty($_POST['subject']) && !empty($_POST['class']))
	{
		require "../requires/connect.php";
		require "../requires/functions.php";
		$title=mysql_real_escape_string($_POST['title']);
		$matter=mysql_real_escape_string($_POST['matter']);
		$subject=mysql_real_escape_string(test_input($_POST['subject']));
		$class0=mysql_real_escape_string(test_input($_POST['class']));
		$class1=mysql_real_escape_string(test_input($_POST['class1']));
		$class2=mysql_real_escape_string(test_input($_POST['class2']));
		if($class0!="All")
		{
			if(!empty($class1) && !empty($class2) &&!empty($class0))
			{
				$class0=$class0.",".$class1.",".$class2;
			}
			else if(!empty($class1) && !empty($class2) && empty($class0))
			{
				$class0=$class1.",".$class2;
			}
			else if(!empty($class1) && !empty($class0))
			{
				$class0=$class0.",".$class1;
			}
			else if(!empty($class1) && empty($class0))
			{
				$class0=$class1;
			}
			else if(!empty($class2) && !empty($class0))
			{
				$class0=$class0.",".$class2;
			}
			else if(!empty($class2) && empty($class0))
			{
				$class0=$class2;
			}
		}
		date_default_timezone_set("Asia/Calcutta");
		$date=date("Y-m-d H:i:s");
		$ip=$_SERVER['REMOTE_ADDR'];
		$filename=basename($_FILES["file"]["name"]);
		//getting mac addres
			require "../requires/mac_address.php";
			$mac=mac_address($ip);
		$file_error=0;
		if(!empty($filename))
		{	
			$target_dir="../upload/";
			$target_file=$target_dir.basename($_FILES["file"]["name"]);
			require "../requires/file_functions.php";
			$filetype=basename($_FILES["file"]["type"]);
			//checking file type
				if($status=filetype_status($filetype))
				{
					if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_file))
					{
						
					}
					else
					{
						$file_error=1;
						echo "not";
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
					$file_error=1;
				}
		}
		//checking of errors while uploading file..
		if($file_error==0)
		{
			
				$r=mysql_query("insert into notification(title,matter,subject,class,date,ip,file,visibility,mac) values ('$title','$matter','$subject','$class0','$date','$ip','$filename','visible','$mac')");
				if($r)
				{
						echo "<script>window.alert('Notifictaion posted successfully')</script>";
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
