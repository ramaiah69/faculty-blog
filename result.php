<html lang="en-us">
	<head>
		<link rel="shortcut icon" href="images/rgu.ico">
		<meta charset="utf-8">
			<title>Results</title>
			<link rel="stylesheet" href="css/style.css">
			<link rel="stylesheet" href="css/table_style.css">
			<link rel="shortcut icon" href="images/rgu.ico">
			<script type="text/javascript" src="js/height.js">	
			</script>
			<style>
				#ttt
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
	<div style="dom">
		<center>
			<span class="titl">Results</span>
			
				<?php
					$id=1;
					require "requires/connect.php";
					$array=mysql_query("select * from result where visibility='visible' order by id desc");
					if(mysql_num_rows($array))
					{
						echo '<table class="notify_table" style="width:90%">';
						echo '<tr><th style="width:1%;">S.No</th><th style="width:35%">Assignment Name</th><th style="width:12%">Send To</th><th style="width:15%">Subject</th><th style="width:20%">Date & Time</th><th style="width:7%">File</th></tr>';
						while ($data=mysql_fetch_assoc($array))
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
							echo '>';
							$a=strtotime($data['date']);
							echo '<td>'.$id.'</td><td class="bold">';
							$title=$data['title'];
							$qq=mysql_query("select class,subject from assignment where title='$title'");
							$qq=mysql_fetch_array($qq);
							echo $data['title'];
							if(date('Y-m-d')==date("Y-m-d",$a))
								{
										echo "&nbsp;&nbsp;&nbsp;<img  src='images/new.gif'>";
										
								}
							echo '</td><td style="width:5%">'.$qq[0].'</td><td style="width:15%">'.$qq[1].'</td><td style="width">'.date("d-m-Y h:i:sa").'</td><td><a class="underline" href="result/'.$data['file'].'" download="'.$data['file'].'">Download</a></td>';
							echo '</tr>';
							$id++;
						}
					}else{
						echo '<br><br>There no results.';
					}
					mysql_close($connection);
				?>
			</table>
			<br>
		</center>
		<br>
	</div>
	</div>
	<div></div>
	<div id="bottomContainer">
		<?php include "footer.php"; ?>
	</div>
</body>
</html>

