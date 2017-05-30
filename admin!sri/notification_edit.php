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
		<title>Edit Notification</title>
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
	<div>
		<?php
		require "../requires/connect.php";
		require "../requires/functions.php";
		if(!empty($_GET['id']))
		{
			$id=mysql_real_escape_string(test_input($_GET['id']));
			$result=mysql_query("select * from notification where id='$id'");
			$ss=mysql_fetch_array($result);
				echo '<center><form method="post" class="form" enctype="multipart/form-data"><br>';
				echo '<h3 class="titl">Edit Notification</h3><hr class="hr"><br>';
				echo '<input type="hidden" name="id" value="'.$ss['id'].'" readonly class="disbled" title="Id of notification"><br><br>';
				echo 'Title:   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="title" value="'.$ss['title'].'"placeholder="Title" title="Title of notificaion">';
				echo '<br><br>';
				echo 'Subject::';
				echo '<select name="subject" required title="Select subject">';
					require "../requires/connect.php";
					$array=mysql_query("select * from current_sem");
					$data=mysql_fetch_array($array);
					$sem=$data['sem'];
					$year=$data['year'];
					$qq=mysql_query("select * from notification where id='$id'");
					$qq=mysql_fetch_array($qq);
					echo '<option name="subject" value="'.$qq['subject'].'">'.$qq['subject'].'</option>';
					$array=mysql_query("select * from subject where sem='$sem' and year='$year'");
					while($data=mysql_fetch_assoc($array))
					{
						echo '<option name="subject" value="'.$data['subject'].'">'.$data['subject'].'</option>';
					}
				echo "</select>";
				echo "<br><br> ";
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
				echo '<textarea name="matter" rows="5" cols="60" placeholder="Type matter here" title="Enter description">'.$ss['matter'].'</textarea>';
				echo '<br><br>';
				echo '<input type="file" name="file" title="Add a file to insert or leave alone">';
				echo '<br><br>';
				echo '<input type="submit" name="newsubmit"><br><br>';
				echo '<br>';
				echo '</form></center>';
				mysql_close($connection);
		}
			
		?>
	</div>
</body>
</html>
<?php
	if(isset($_POST['newsubmit']))
	{
		if(!empty($_POST['id']) && !empty($_POST['title']) && !empty($_POST['matter']))
		{
			//getting data by post
				require "../requires/connect.php";
				$id=mysql_real_escape_string(test_input($_POST['id']));
				$title=mysql_real_escape_string($_POST['title']);
				$matter=mysql_real_escape_string($_POST['matter']);
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
			//file uploading
				$fileupload_error=0;
				
				$filename=basename($_FILES["file"]["name"]);
				if($filename)
				{
					$target_dir="../upload/";
					$target_file=$target_dir.basename($_FILES["file"]["name"]);
					require "../requires/file_functions.php";
					$filetype=$_FILES["file"]["type"];
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
						echo 'File was not uploaded.<br>Only  ';
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
			
			//inserting data into database
			if($fileupload_error==0)
			{
				if($filename)
				{
					$r=mysql_query("update notification set title='$title',matter='$matter',class='$class0',ip='$ip',file='$filename',mac='$mac' where id='$id'");
				}
				else
				{
					$r=mysql_query("update notification set title='$title',matter='$matter',class='$class0',ip='$ip',mac='$mac' where id='$id'");
				}
				if($r)
				{
					echo '<script>window.alert("Notification Updated")</script>';	
				}
				else
				{
					echo "Not";
				}
			}
		}
	}

?>
