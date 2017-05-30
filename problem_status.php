<html lang="en-us">
<head>
	<link rel="shortcut icon" href="images/rgu.ico">
	<title>Problem Status</title>
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
		
			
	</style>
	<script>
		function load()
		{
			alert("ss");
		}
	</script>
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
					<input type="text" name="id" onKeyup="load_status();" id="id1" placeholder="Enter id">
					
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
