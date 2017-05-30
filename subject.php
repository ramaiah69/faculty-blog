<html lang="en">
<head>
	<link rel="shortcut icon" href="images/rgu.ico">
	<meta charset="utf-8">
	<title>Subjects</title>
	<link rel="stylesheet" href="css/style.css">	
	<link rel="stylesheet" href="css/table_style.css">
	<script type="text/javascript" src="js/height.js"></script>
	<style>		
		#ttt
		
		{
			border-top:4px solid #28B886;
			background-color:#E5E5E5;
			color:black;
		}
			#sub{
				
				border-radius:2px;
				text-align:center;
				width:160px;
				white-space:normal;
				box-shadow:0px 0px 1px 2px rgba(0,0,2,0.1);
			}
			#sub:hover
			{
				box-shadow:0px 0px 5px 3px rgba(0,0,10,0.2);
			}
			.div1
			{
			min-height:140px;
			height:relative;
			background-color:#F3F3F3;
			background:linear-gradient(to bottom,white,#EEEEEE);
			padding:0px;
			font-weight:bold;
			color:red;
			font-size:21px;
			text-align:center;
			width:150px;
			word-break:break-all;
			line-height:22px;
			}
			a
			{
				white-space:normal;
				word-break:break-all
				text-decoration:none;
			}
			.mm a:hover
			{
				text-decoration:underline;
			}
			.div2
			{
				
				background-color:#FFFFFF;
				padding:8px;
				font-size:14px;
				text-align:center;
			}
			.ds {display:inline-block;margin-left:20px;}
	</style>
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
				<center><span class="titl">Subjects</span></center>
			
			<CENTER>
				<?php
					require "requires/connect.php";
						$query=mysql_query("select * from current_sem");
						$qq=mysql_fetch_array($query);
						$sem=$qq['sem'];
						$year=$qq['year'];
						$query=mysql_query("select * from subject where year='$year' and sem='$sem'");
						
						$count=0;
					if(mysql_num_rows($query))
					{
						echo '<ul style="list-style:none">';
						while($row=mysql_fetch_assoc($query))
						{
							if($count%5==0)
								echo "<br><br>";
							echo '<li class="ds">';
							echo '<div  id="sub"><center>';
							echo '<div class="div1"><br><span style="color:green;font-size:14px;padding:0px;">'.$row['subject'].'</span></div></center>';
							echo '<div class="div2" ><a class="mm"  href="in_subject.php?subject='.$row['subject'].'" >Clickme</a></div>';
							echo '</li>';
							$count++;
						}
						echo '</ul>';
					}
					else
					{
						echo '<br>There is no subjects';
					}
					mysql_close($connection);
				?>
				
			
			<br><br>
			</CENTER>
		</div>
	</div>
	
	<div></div>
	<div id="bottomContainer">
		<?php include "footer.php"; ?>
	</div>
</body>
</html>
