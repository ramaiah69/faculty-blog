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
		<link rel="shortcut-icon" href="">
		<title>Assignment Post</title>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/notification_style.css">
		<script>
			
		</script>
		<style>
			
		</style>
	</head>
<body>
	<div class="form">
		<center>
			<br>
			<h3 class="titl">Post a Assignment<hr class="hr"></h3>
			<form method="post" enctype="multipart/form-data">
				<input type="text" name="title" placeholder="title" title="select title" required><br><br>
				
				<?php
					require "../requires/connect.php";
					$array=mysql_query("select * from current_sem");
					$data=mysql_fetch_array($array);
					$sem=$data['sem'];
					$year=$data['year'];
					
					//
					echo '<select name="subject" required title="Select subject">';
					echo '<option name="subject" value="">Select a Subject</option>';
						$r=mysql_query("select subject from subject");
						while($row=mysql_fetch_assoc($r))
						{
							echo '<option name="subject" value="'.$row['subject'].'">'.$row['subject'].'</option>';
						}
					echo '</select><br><br>';
					echo '<select name="class">';
					echo '<option name="class" value="" title="Select class">Select Class</option>';
					$array=mysql_query("select * from class where sem='$sem' and year='$year'");
					while($data=mysql_fetch_assoc($array))
					{
						echo '<option name="class" value="'.$data['class'].'">'.$data['class'].'</option>';
					}
					echo '<option name="class" value="All">All</option>';
					echo '</select>';
					echo '<br><br>';
					echo '<select name="class1" value="">';
					echo '<option name="class1" value="">Select Class</option>';
					
							$array=mysql_query("select * from class where sem='$sem' and year='$year'");
							while($data=mysql_fetch_assoc($array))
							{
								echo '<option name="class1" value="'.$data['class'].'">'.$data['class'].'</option>';
							}
							
				
					echo '</select><br><br>';
					echo '<select name="class2" value="">';
					echo '<option name="class2" value="">Select Class</option>';
					
							$array=mysql_query("select * from class where sem='$sem' and year='$year'");
							while($data=mysql_fetch_assoc($array))
							{
								echo '<option name="class2" value="'.$data['class'].'">'.$data['class'].'</option>';
							}
					
					echo '</select><br><br>';
					mysql_close($connection);
				?>
				
				<!--<input type="checkbox" style="padding:10x;"name="visible" value="visible">Ok<br><br>-->
				
				
				<input type="file" name="file" required><br><br>
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
		if(!empty($_POST['title']) && !empty($_POST['subject']) &&!empty($_POST['class']))
		{
			require "../requires/connect.php";
			require "../requires/functions.php";
			$title=mysql_real_escape_string(test_input($_POST['title']));
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
			$time=date("H:i:sa");
			$ip=$_SERVER['REMOTE_ADDR'];
			$filename=basename($_FILES["file"]["name"]);
			$file_error=0;
			//getting mac 
				require "../requires/mac_address.php";
				$mac=mac_address($ip);
			//uploading file
			$filename=basename($_FILES["file"]["name"]);
			if($filename)
			{
				$target_dir="../assignment/";
				$target_file=$target_dir.basename($_FILES["file"]["name"]);
				$filetype=$_FILES["file"]["type"];
				require "../requires/file_functions.php";
				if(filetype_status($filetype))
				{
					if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_file))
					{
						
						//$s=mysql_query("insert into assignment (title,subject,class,file,date,time,ip,mac)values ('$title','$subject','$class0','$filename','$date','$time','$ip','$mac')");
						$s=mysql_query("insert into assignment (title,subject,class,file,date,ip,mac) values ('$title','$subject','$class0','$filename','$date','$ip','$mac')");
						if($s)
						{
							$title="Reg: Assignment for ".$class0;
							$matter="Please, find the new assignment in <b>Teaching -> Assignments</b>.";
							$r=mysql_query("insert into notification(title,matter,subject,class,date,ip,visibility,mac) values ('$title','$matter','$subject','$class0','$date','$ip','visible','$mac')");
							if($r)
							{
								echo '<script>';
								echo 'alert("Assignment posted successfully");</script>';
							}
							
						}
						else
						{
							echo 'not posted';
						}
					}
					else
					{
						echo 'Not uploaded file';
						$fileupload_error=1;
					}
				}
				else
				{
					$array=mysql_query("select * from file_type");
					echo 'File was not uploaded.Your file is '.$filetype.'.<br>Only  ';
					while($result=mysql_fetch_assoc($array))
					{
						echo ".".$result['type']."&nbsp;&nbsp;";
					}
					echo "file extensions are allowed";
					$fileupload_error=1;
				}
				
			}
			else
				echo 'FIll details without empty';
			mysql_close($connection);
		}
		else
		{
			echo 'FIll details without empty';
		}
	}
?>
