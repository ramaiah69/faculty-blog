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
	<script>
		function conform()
		{
			if(confirm("Are you sure")==true)
			{
				window.location("assignment_post.php");
			}
			
		}
	</script>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/notification_style.css">
	<title>Student Add</title>
	<script>
		function add_students()
		{
			var count=document.getElementById("count").value;
			var i=1;
			document.getElementById("students").innerHTML="";
			while(i<=count)
			{
				document.getElementById("students").innerHTML+="<input type='text' name='name"+i+"' placeholder='Student"+i+" Name'> &nbsp;&nbsp;<input type='text' name='id"+i+"' placeholder='id"+i+"'><br><br>";
				i++;
			}			
		}
		
	</script>
</head>
<body>
	<div class="form">
		<center>
			<br>
			<h3 class="titl">Add Students<hr class="hr"></h3>
			<form method="post" enctype="multipart/form-data">
				<select name="batch" required title="Select batch">
					<option name="batch" value="">Slect a Batch</option>
					<option name="batch" value="btech">BTECH</option>
					<option name="batch" value="mtech">MTECH</option>
					<option name="batch" value="phd">PHD</option>
				</select>
				<br><br>
				<select name="year" required title="select year">
					<option name="year" value="">Select Year</option>
					<?php
						$year_now=date("Y")-1;
						$year=$year_now+2;
						while($year_now<=$year)
						{
							echo '<option name="year" value="'.$year_now.'">'.$year_now.'</option>';
							$year_now++;
						}
					?>
				</select>
				<br><br>
				<!--
				<select name="sem">
					<option name="sem" value="">Slect a Sem</option>
					<option name="sem" value="sem1">Sem1</option>
					<option name="sem" value="sem2">Sem2</option>
					<option name="sem" value="summer">Summer/option>
					<option name="sem" value="winter">Winter/option>
				</select>
				<br><br>-->
				<input name="count" id="count" type="number" placeholder="Number of students" onKeyup="add_students()" title="Enter number of students to add">
				<br><br>
				<div id="students">
					
				</div>
				
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
	
		if(!empty($_POST['count']) && !empty($_POST['year']) /*&& !empty($_POST['sem'])*/ && !empty($_POST['batch']))
		{
			require "../requires/connect.php";
			require "../requires/functions.php";
			$count=mysql_real_escape_string(test_input($_POST['count']));
			//$sem=mysql_real_escape_string(test_input($_POST['sem']));
			$batch=mysql_real_escape_string(test_input($_POST['batch']));
			$year=mysql_real_escape_string(test_input($_POST['year']));
			/*date_default_timezone_set("Asia/Calcutta");
			$date=date("Y-m-d");
			$time=date("h:i:sa");
			$ip=$_SERVER['REMOTE_ADDR'];
			
			}*/
			$r=0;
			for($i=1;$i<=$count;$i++)
			{
				$id="id".$i;
				$name="name".$i;
				if(!empty($_POST["$name"]))
				{
					$id=strtoupper(mysql_real_escape_string(test_input($_POST["$id"])));
					$name=mysql_real_escape_string(test_input($_POST["$name"]));
					$r=mysql_query("insert into $batch (name,id,year) values ('$name','$id','$year')");
				}
				
			}
			if($r)
			{
				echo '<script>alert("Added successfully");</script>';
			}
			else
			{
				echo 'Not added';
			}
			mysql_close($connection);
		}
	}
?>
