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
	<title>Edit Research</title>
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
</body>
</html>
<?php

if(!empty($_GET['id']))
{
	require "../requires/connect.php";
	require "../requires/functions.php";
	$id=mysql_real_escape_string(test_input($_GET['id']));
	$result=mysql_query("select * from research where id='$id'");
	$ss=mysql_fetch_array($result);
		echo '<center><form method="post" class="form" enctype="multipart/form-data"><br>';
		echo '<h3 class="titl">Edit a Research</h3><hr class="hr"><br>';
		echo '<input type="text" name="id" value="'.$ss['id'].'" readonly class="disblaed" title="Id of research"><br><br>';
		echo '<input type="text" name="title" value="'.$ss['title'].'"placeholder="Title" title="Title of research">';
		echo '<br><br>';
		echo '<textarea name="matter" rows="5" cols="60" placeholder="Type matter here" title="Description of research">'.$ss['description'].'</textarea>';
		echo '<br><br>';
		echo '<input type="file" name="file" id="fileToUpload" title="Add a file or leave alone">';
		echo '<br><br>';
		echo '<input type="submit" name="newsubmit"><br><br>';
		echo '<br>';
		echo '</form></center>';
}
	
?>
<?php
	if(isset($_POST['newsubmit']))
	{
		if(!empty($_POST['id']) && !empty($_POST['title']) && !empty($_POST['matter']))
		{
			//getting data by post
				$id=mysql_real_escape_string(test_input($_POST['id']));
				$title=mysql_real_escape_string($_POST['title']);
				$matter=mysql_real_escape_string($_POST['matter']);
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
					require "../requires/file_functions.php";
					$target_dir="../research/";
					$target_file=$target_dir.basename($_FILES["file"]["name"]);
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
			
			//update data into database
			if($fileupload_error==0)
			{
				if($filename)
				{
					$r=mysql_query("update research set title='$title',description='$matter',ip='$ip',file='$filename',mac='$mac' where id='$id'");	
				}
				else
				{
					$r=mysql_query("update research set title='$title',description='$matter',ip='$ip',mac='$mac' where id='$id'");
				}
				if($r)
				{
					echo '<script>window.alert("Research Updated")</script>';
					
				}
				else
				{
					echo "Not";
				}
			}
		}
	}
?>


