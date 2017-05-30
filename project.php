<html lang="en-us">
<head>
	<link rel="shortcut icon" href="images/rgu.ico">
	<title>project</title>
	<link rel="stylesheet" href="css/style.css">	
	<link rel="stylesheet" href="css/table_style.css">
	<link rel="stylesheet" href="css/notification_style.css">
	<script type="text/javascript" src="js/students.js">
	</script>
	<script type="text/javascript" src="js/height.js">	
	</script>
	<style>
		table,tr,td
		{
			border:1px solid #C5C5C5;
		}			
		#ttpr
		{
			border-top:4px solid #28B886;
			background-color:#E5E5E5;
			color:black;
		}
			
	</style>
</head>
<body onLoad='height_set()'>
	<div class="container">
	<div class="main">
		<?php include "main_header.php";?>
	</div>
	<div class="header" style="background-color:black">
		<?php include "head.php";?>
	</div>
	<div class="cc" id="cc">
		<br>
		<div class="dom">
			<center>
				<div style="">
					<select style="width:25%" id="batch" name="year" onChange="load_project()" name="type" value="">Select a Batch</option>
						<option name="type" value="BTECH">BTECH</option>
						<option name="type" value="MTECH">MTECH</option>
						<option name="type" value="PHD">PHD</option>
					</select>
					<select style="width:25%" id="year" name="year" onChange="load_project()">
						<?php
							date_default_timezone_get("Asia/Calcutta");
							$year_now=date("Y")-1;
							$year=$year_now+1;
							echo '<option name="year" value="">Select Year</option>';
							while($year_now<=$year)
							{
								echo '<option name="year" value="'.$year_now.'">'.$year_now.'</option>';
								$year_now++;
							}
						?>
					</select>
				</div>
				<br>
				<div id="details">
					Select batch and year for deatils.
					<br><br>
				</div>
			</center>
		</div>
	</div>
	<div></div>
	<div id="bottomContainer">
		<?php include "footer.php"; ?>
	</div>
	</div>
</body>
</html>
