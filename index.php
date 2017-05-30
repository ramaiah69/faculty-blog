<html>
<head>
	<link rel="shortcut icon" href="images/rgu.ico">
	<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="Keywords" content="Assistant Professor">
<meta name="Description" content="">
	
	<title>Home</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/table_style.css">
	<link rel="stylesheet" href="css/modal.css">
	<link rel="stylesheet" href="css/public.css">
	<!--<link rel="shortcut icon" href="images/rgu.ico">-->
	<script type="text/javascript" src="js/height.js">	
	</script>
	<script type="text/javascript" src="js/modal.js">
	
	</script>
	<style>
		#tth
		{
			border-top:4px solid #28B886;
			background-color:#E5E5E5;
			color:black;
		}
	</style>
</head>

<body onLoad="height_set()">
	<div class="pagecontainer">
		<div class="main">
			<?php include "main_header.php";?>
		</div>
		<div class="header" style="background-color:black">
			<?php include "head.php";?>
		</div>
		<div id="notification" style="border-bottom:2px solid #D7D7D7">
			<?php include "nots.php"; ?>
		</div>
		<div class="cc" id="cc" style=" background-color:#ECECEC;">	
			<div style="dom">
				<?php include "sri.php"; ?>
			</div>
		</div>
		<div><div id="myModal" class="modal">

  <!-- Modal content -->
 

</div></div>
		<div id="bottomContainer">
			<?php include "footer.php"; ?>
		</div>
	</div>
</body>
</html>

