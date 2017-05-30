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
		<title>Edit gallery</title>
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
			$result=mysql_query("select * from gallery where id='$id'");
			$ss=mysql_fetch_array($result);
				echo '<center><form method="post" class="form" enctype="multipart/form-data"><br>';
				echo '<h3 class="titl">Edit gallery</h3><hr class="hr"><br><br>';
				echo '<input type="text" name="id" value="'.$ss['id'].'" class="disabled" readonly title="Id of image in gallery"><br><br>';
				echo '<input type="text" name="description" value="'.$ss['description'].'"placeholder="description" title="Description of image"><br><br>';
				echo '<input type="file" name="file" title="Add a file to update">';
				echo '<br><br>';
				echo '<input type="submit" name="newsubmit"><br><br>';
				echo '<br>';
				echo '</form></center>';
		}
			
		?>
	</div>
</body>
</html>
<?php
	if(isset($_POST['newsubmit']))
	{
		if(!empty($_POST['id']) && !empty($_POST['description']))
		{
			//getting data by post
				$id=mysql_real_escape_string(test_input($_POST['id']));
				$description=mysql_real_escape_string(test_input($_POST['description']));
				date_default_timezone_set("Asia/Calcutta");
				$date=date("Y-m-d");
				$time=date("H:i:sa");
				$ip=$_SERVER['REMOTE_ADDR'];
			//file uploading
				$fileupload_error=0;
				
				$filename=basename($_FILES["file"]["name"]);
				if($filename)
				{
					$target_dir="../img/";
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
					$r=mysql_query("update gallery set description='$description',date='$date',time='$time',ip='$ip',file='$filename',mac='$mac' where id='$id'");
				}
				else
				{
					$r=mysql_query("update gallery set description='$description',date='$date',time='$time',ip='$ip',mac='$mac' where id='$id'");
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

