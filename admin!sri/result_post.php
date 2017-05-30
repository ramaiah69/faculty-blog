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
		<title>Result Post</title>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/notification_style.css">
		<script>
			function option_change(title)
			{
				
				xmlhttp=getxmlobject();
				
				if(xmlhttp==null)
				{
					alert("Your browser doesnot support http");
				}
				else
				{
					var url='r_post.php?title='+title;
					xmlhttp.open("GET",url,false);
					xmlhttp.send(null);
					document.form.subject.value=xmlhttp.responseText;
					
				}
			}
			function getxmlobject()
			{
				if(window.XMLHttpRequest)
				{
					return new XMLHttpRequest;
				}
				if(window.ActiveXObject)
				{
					return new ActiveXObject("Microsoft.XMLHTTP");
				}
				return ;
			}
		</script>
	</head>
<body>
	<div class="form">
		<center>
			<br>
			<h3 class="titl">Post Result<hr class="hr"></h3>
			<form method="post" name="form" enctype="multipart/form-data">
				<select name="title" id="title" onChange="option_change(this.value)" style="max-height:100px" required title="Select a assignment">
					<option name="title" value="#" >Select a assignment</option>
					<?php
						require "../requires/connect.php";
						$r=mysql_query("select * from assignment where title not in (select title from result)");
						while($row=mysql_fetch_assoc($r))
						{
							echo '<option name="title" value"'.$row['title'].'">'.$row['title'].'</option>';
						}
						mysql_close($connection);
					?>
				</select>
				<br><br>
				<input type="text" name="subject" placeholder="Subject" class="disabled" class="disabled" title="Subject of result" readonly><br><br>
				<input type="file" name="file" required title="Must add a file"><br><br>
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
		if(!empty($_POST['title']) && !empty($_POST['subject']))
		{
			require "../requires/connect.php";
			require "../requires/functions.php";
			$title=mysql_real_escape_string(test_input($_POST['title']));
			$subject=mysql_real_escape_string(test_input($_POST['subject']));
			date_default_timezone_set("Asia/Calcutta");
			$date=date("Y-m-d H:i:s");
			$time=date("h:i:sa");
			$ip=$_SERVER['REMOTE_ADDR'];
			$target_dir="../result/";
			$target_file=$target_dir.basename($_FILES["file"]["name"]);
			$file=basename($_FILES["file"]["name"]);
			require "../requires/connect.php";
			//getting mac address;
				require "../requires/mac_address.php";
				$mac=mac_address($ip);
			//file uploading
				$fileupload_error=0;
				$filename=basename($_FILES["file"]["name"]);
				if($filename)
				{
					require "../requires/file_functions.php";
					$target_dir="../result/";
					$target_file=$target_dir.basename($_FILES["file"]["name"]);
					$filetype=$_FILES["file"]["type"];
					if(filetype_status($filetype))
					{
						if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_file))
						{
							$qq=mysql_query("select class from assignment where title='$title'");
							$qq=mysql_fetch_array($qq);
							$class0=$qq[0];
							$query=mysql_query("insert into result (title,subject,file,date,ip,mac) values ('$title','$subject','$file','$date','$ip','$mac')");
							$title="Reg: Result for ".$title;
							$matter="Please, find the result in <b>Teaching -> Result</b>.";
							$r=mysql_query("insert into notification(title,matter,subject,class,date,ip,visibility,mac) values ('$title','$matter','$subject','$class0','$date','$ip','visible','$mac')");
							if($r)
							{
								echo '<script>';
								echo 'alert("Assignment posted successfully");</script>';
							}
						}
						else
						{
							echo 'Not uploaded file';
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
				{
					echo 'File attachemnt is compulsery';
				}
			mysql_close($connection);
		}
		
	}
?>
