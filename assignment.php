<html lang="en-us">
	<meta charset="utf-8">
	<head>
		<link rel="shortcut icon" href="images/rgu.ico">
		<title>Assignments</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/table_style.css">
		<!--<link rel="shortcut icon" href="images/rgu.ico">-->
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
				<span class="titl">Assignments</span>
				<?php
					require "requires/connect.php";
					$array=mysql_query("select * from assignment where visibility='visible' order by id desc");
					if(mysql_num_rows($array))
					{
						echo '<table class="notify_table" style="width:90%">';
						echo '<tr><th style="width:1%;">S.No</th><th style="width:35%">Title</th><th style="width:12%">Send To</th><th style="width:15%">Subject</th><th style="width:20%">Date & Time</th><th style="width:7%">File</th></tr>';
						
							$id=1;
							
							if(mysql_num_rows($array))
							{
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
									echo $data['title'];
									if(date('Y-m-d')==date("Y-m-d",$a))
									{
											echo "&nbsp;&nbsp;&nbsp;<img  src='images/new.gif'>";
											
									}
									
									echo '</td><td>'.$data['class'].'</td><td>'.$data['subject'].'</td><td style="width">'.date("d-m-Y h:i:sa",$a).'</td><td><a  class="underline" href="assignment/'.$data['file'].'" download="'.$data['file'].'">Download</a></td>';
									echo '</tr>';
									$id++;
								}
							}
							else
							{
								echo 'There is no assignment.';
							}
							mysql_close($connection);
						
					echo '</table><br>';
					}
					else
					{
						echo '<br><br>There is not assignments';
					}
				?>
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

