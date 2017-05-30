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
		<title>Check and Add file type</title>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/notification_style.css">
	</head>
<body><br>

	<div class="form">
		<center>
		<br>
		<span class="titl">Check and add file type</span><hr class="hr"><br><br>
	<form method="post" enctype="multipart/form-data">
		<input type="file" name="file" title="Add a file to check and update"><br><br>
		
		<input type="submit" name="submit">
		<br><br>
		</center>
	</form>
	
	</div>
</body>
</html>
<?php
	if(isset($_POST['submit']))
	{
			$type=basename($_FILES["file"]["type"]);
			require "../requires/connect.php";
			if(!empty($type))
			{
				$r=mysql_query("select * from file_type where type='$type'");
				$r=mysql_fetch_array($r);
				if(empty($r['type']))
				{
					$d=mysql_query("insert into file_type (type) values ('$type')");
					if($d)
					{
						echo '<script>alert("file type added.")</script>';
					}
					else
					{
						echo 'Not added';
					}
				}
				else
				{
					echo 'Already uploaded';
				}
			}
			else
			{
				echo 'Fill attachment';
			}
			
	}
?>

