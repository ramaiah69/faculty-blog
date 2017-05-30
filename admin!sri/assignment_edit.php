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
		<title>Edit Assignment</title>
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
	<br>
	<?php
	if(!empty($_GET['id']))
	{
		require "../requires/connect.php";
		require "../requires/functions.php";
		$id=mysql_real_escape_string(test_input($_GET['id']));
		$result=mysql_query("select * from assignment where id='$id'");
		$ss=mysql_fetch_array($result);
		echo '<center><form method="post" class="form" enctype="multipart/form-data"><br>';
		echo '<h3 class="titl">Edit a Assignment</h3><hr class="hr"><br>';
		echo '<input type="text" name="id" value="'.$ss['id'].'" readonly class="disabled" title="Id of assignment"><br><br>';
		echo '<input type="text" name="title" value="'.$ss['title'].'"placeholder="Title" title="Title of assignment">';
		echo '<br><br>';
		echo '<select name="subject" value="" title="Select subject">';
			echo '<option name="subject" value="'.$ss['subject'].'">'.$ss['subject'].'</option>';
			$query=mysql_query("select * from current_sem");
			$result=mysql_fetch_array($query);
			$sem=$result['sem'];
			$year=$result['year'];
			$query2=mysql_query("select * from subject where sem='$sem' and year='$year'");
			while($result2=mysql_fetch_assoc($query2))
			{
				echo '<option name="subject" value="'.$result2['subject'].'">'.$result2['subject'].'</option>';
			}
		echo '</select>';
		echo '<br><br>';
		$i=0;
				$arr=explode(",",$ss['class']);
				while($i<3)
				{
					
					echo '<select name="class'.$i.'" value="" title="Select class">';
					if(!empty($arr[$i]))
					{
						echo '<option name="class'.$i.'" value="'.$arr[$i].'">'.$arr[$i].'</option>';
						echo '<option name="class'.$i.'" value="">Delete this class</option>';
					}
					else
						echo '<option name="class'.$i.'" value="">Select Another class</option>';
						
					$array=mysql_query("select * from class where sem='$sem' and year='$year'");
					while($data=mysql_fetch_assoc($array))
					{	
						echo '<option name="class'.$i.'" value="'.$data['class'].'">'.$data['class'].'</option>';
						
					}
					if($i==0)
						echo '<option name="class0" value="All">All</option>';
					echo '</select><br><br>';
					$i++;
				}
		echo '<input type="file" name="file" id="fileToUpload" title="Select file to upload">';
		echo '<br><br>';
		echo '<input type="submit" name="newsubmit"><br><br>';
		echo '<br>';
		echo '</form></center>';
		mysql_close($connection);
	}
		
	?>
</body>
</html>
<?php
	if(isset($_POST['newsubmit']))
	{
		if(!empty($_POST['id']) && !empty($_POST['title']))
		{
			//getting data by post
				require "../requires/connect.php";
				$id=mysql_real_escape_string(test_input($_POST['id']));
				$title=mysql_real_escape_string(test_input($_POST['title']));
				$subject=mysql_real_escape_string(test_input($_POST['subject']));
				$class0=mysql_real_escape_string(test_input($_POST['class0']));
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
				$date=date("Y-m-d");
				$time=date("H:i:sa");
				$ip=$_SERVER['REMOTE_ADDR'];
				$fileupload_error=0;
			//file uploading
				$fileupload_error=0;
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
			
			//getting mac adress
				require "../requires/mac_address.php";
				$mac=mac_address($ip);
			
			//update data into database
			if($fileupload_error==0)
			{
				if($filename)
				{
					$r=mysql_query("update assignment set title='$title',class='$class',subject='$subject',ip='$ip',file='$filename',mac='$mac' where id='$id'");
				}else
				{
					$r=mysql_query("update assignment set title='$title',class='$class0',subject='$subject',ip='$ip',mac='$mac' where id='$id'");
				}
				if($r)
				{
					echo '<script>window.alert("Assignemnt Updated")</script>';
					
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




