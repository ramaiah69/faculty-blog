<?php
	error_reporting(0);
?>
<html>
<head>
	<link rel="shortcut icon" href="images/rgu.ico">
	<title>Contact</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/notification_style.css">
</head>
<body onLoad="height_set()">
	<div class="main">
		<?php include "main_header.php";?>
	</div>
	<div class="header" style="background-color:black">
		<?php include "head.php";?>
	</div>
	
	<div class="cc" id="cc"><br>
		<div class="dom">
			<div class="form2">
				<center>
				<br>
				<?php
					echo $err;
				?>
					<h3 class="titl">Contact Us<hr class="hr"></h3>
					<form method="post" enctype="multipart/form-data">
						<?php echo $err;?>
						<input type="text" name="username" placeholder="ID" maxlength="7" required><br><br>
						<select name="class" required>
							<option name="class" value="">Select Class</option>
							<?php
								require "requires/connect.php";
								$array=mysql_query("select * from current_sem");
								$data=mysql_fetch_array($array);
								$sem=$data['sem'];
								$year=$data['year'];
								$query=mysql_query("select * from class where sem='$sem' and year='$year'");
								while($data=mysql_fetch_assoc($query))
								{
									echo '<option name="class" value="'.$data['class'].'">'.$data['class'].'</option>';
								}
							?>
							<option name="class" value="other">Other</option>
						</select>
						<br><br>
						<select name="problem_type" required>
							<option name="">Select type</option>
							<option name="problem_type" value="problem">Problem</option>
							<option name="problem_type" value="feedback">Feedback</option>
							<option name="problem_type" value="suggestion">Suggestion</option>
						</select>
						<br><br>
						<textarea cols=50 rows=5 name="description" placeholder="Description" required></textarea><br><br>
						<input type="submit" name="submit" value="Submit"><br><br>
						<a href="problem_status.php" style="">Problem status</a>
					</form>
					<br>
					
				</center>
				
			</div>
		</div>
		
		<br><br>
	</div>
	<div></div>
		<div id="bottomContainer">
			<?php include "footer.php"; ?>
		</div>
	</div>
</body>
</html>
<?php
	if(isset($_POST['submit']))
	{
		if(!empty($_POST['username']) && !empty($_POST['problem_type']) && !empty($_POST['description']) && !empty($_POST['class']))
		{	
			require "requires/functions.php";
			$username=strtoupper(mysql_real_escape_string(test_input($_POST['username'])));
			if(strlen($username)==7 )
			{
				if($username[0]=='N' || $username[0]=='B' || $username[0]=='R')
				{
					$class=mysql_real_escape_string(test_input($_POST['class']));
					$problem_type=mysql_real_escape_string(test_input($_POST['problem_type']));
					$description=mysql_real_escape_string(test_input($_POST['description']));
					
					date_default_timezone_set("Asia/Calcutta");
					$date=date("Y-m-d");
					$time=date("h:i:s a");
					$ip=$_SERVER['REMOTE_ADDR'];
					//mac
					require "requires/mac_address.php";
					$mac=mac_address($ip);
					$query=mysql_query("insert into problem (sendby,problem_type,description,date,time,ip,mac) values ('$username','$class','$problem_type','$description','$date','$time','$ip','$mac')");
					if($query){echo '<script>alert("Posted successfully.")</script>';}
					else{echo 'not posted.';}
					mysql_close($connection);
				}
				else
				{
					
					echo  '<script>alert("Enter valid id");</script>';
				}
			}
		}
		else{echo "Enter details without empty";}
	}
?>
