<HTML lang="en-us">
<HEAD>
	<link rel="shortcut icon" href="images/rgu.ico">
	<title>Jounals</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/public_style.css">
	<script type="text/javascript" src="js/height.js"></script>
	<style>	
		#ttpb
		{
			border-top:4px solid #28B886;
			background-color:#E5E5E5;
			color:black;
		}
		p{
			font-weight:100;
			font-family:times new roman;
			margin-left:12px;
			text-indent:25px;
			line-height:125%;
			color:#000000;
			font-size:16px;
			text-align:left;
		}
	</style>		
</HEAD>	
<body onLoad="height_set()" onResize="height_set()">
	<div class="main">
		<?php include "main_header.php";?>
	</div>
	<div class="header" style="background-color:black">
		<?php include "head.php";?>
	</div>
	<div id="cc"><br> 
		<div id="dom">
			<center> 
				<span class="titl" style="">Journals</span>
				<?php
					require "requires/connect.php";
					$array=mysql_query("select * from article where type='journal' and visibility='visible' order by published_year desc");
					echo '<br>';
					if(mysql_num_rows($array))
					{
						while($data=mysql_fetch_assoc($array))
						{
							echo '<div id="pub"">';
								echo '<font id="head"><span class="left" style="">'.$data['title'].'</span><span class="right" style="font-size:15px">Published Year:'.$data['published_year'].'</span></font>';
								echo '<br><br><div style="background-color:#FAFAFA;border-radius:7px;"><br>';
							
									echo '<p style="line-height:22px;" id="msg" >'.$data['description'].'<br><br>';
									if($data['file'])
									{
										echo '<a style="padding:10px;margin-left:20px;"href="article/'.$data['file'].'" download="'.$data['file'].'">Click for attachment</a>';
									}
									echo '</p><br></div>';
								
							echo '</div><br><br>';
							
						}
					}
					else
					{
						echo '<br>There is no journals.';
					}
					mysql_close($connection);
				?>
			</center>
		</div>
		
	</div>
	<div></div>
	<div id="bottomContainer">
		<?php include "footer.php"; ?>
	</div>
</body>
</HTML>
