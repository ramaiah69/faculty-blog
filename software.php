<html lang="en">
<head>
	<link rel="shortcut icon" href="images/rgu.ico">
	<meta charset="utf-8">
	<title>Softwares</title>
	<link rel="stylesheet" href="css/style.css">	
	<link rel="stylesheet" href="css/table_style.css">

	<script type="text/javascript" src="js/height.js"></script>
	<style>
				
		#ttso
		{
			border-top:4px solid #28B886;
			background-color:#E5E5E5;
			color:black;
		}
	</style>
</head>
<body onLoad="height_set()">
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
					<span class="titl">Softwares</span>
					<br>
				<table class="notify_table" style="width:70%">
					<tr><th style="width:5%;">S.No</th><th style="width:80%">File Name</th><th style="text-align:center;">File</th></tr>
					<?php
						$id=1;
						$dir="software/";
						if(is_dir($dir))
						{
							if($dh=opendir($dir))
							{
								while($rr=readdir($dh))
								{
									if($rr=="." || $rr==".." || $rr=='index.php')
									{
										
									}
									else
									{
										echo '<tr';
										if($id%2==0)
										{
											echo ' class="even"';
										}
										else
										{
											echo ' class="odd"';
										}
										echo '><td>'.$id.'</td><td class="bold">'.$rr.'</td><td style="text-align:center"><a class="underline" href="software/'.$rr.'" download="'.$rr.'">Download</a></td>';
										echo '</tr>';
										$id++;
									}
								}
							}
							closedir($dh);
						}
					?>
				</table>
			</center>
			<br><br>
		</div>
	</div>
	<div></div>
	<div id="bottomContainer">
		<?php include "footer.php"; ?>
	</div>
</body>
</html>
