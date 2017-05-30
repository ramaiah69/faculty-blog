<html>
<head>
	<link rel="shortcut icon" href="images/rgu.ico">
	<title>Notification</title>
<style>
	body
	{
		font-family:sans sarief;
	}
.left
{
	float:left;
}
.right
{
	float:right;
}
/* Modal Header */
.modal-header 
	{
		padding: 2px 16px;
		background-color: #5cb85c;
		color: white;
	}
/* Modal Body */
.modal-body 
	{
		padding: 2px 16px;
	}
.modal-footer 
	{
		height:40px;
		background-color: #5cb85c;
		
	}
	.mm
	{
		padding:8px 11px 10px;
	}
.blue
{
	color:blue;
}
/* Modal Content */
.modal-content 
	{
		position: relative;
		background-color: #fefefe;
		margin: auto;
		padding: 0;
		border: 1px solid #888;
		width: 80%;
		box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0
		rgba(0,0,0,0.19);
	}
.views
{
	font-size:22px;
	color:#004A4A;
}
.lblue
{
	font-size:14px;
	color:black;
}
</style>
<script>
	function mad()
	{
		var height=screen.availHeight;
		var width=screen.availWidth;
		
		document.getElementById("modal-body").style.minHeight=(height*1.5)/10;
		document.getElementById("modal-body").style.minWidth="100%";
		document.getElementBy("modal-body").style.color="blue";
		
	}
</script>
</head>
<body onload="mad()">
	<div style="margin-top:2%;">
	
	</div id="mai">
	<?php
		echo '<div class="modal-content">';
		echo '<div class="modal-header">';
			require "requires/connect.php";
			require "requires/functions.php";
			$id=test_input(mysql_real_escape_string(test_input($_GET['id'])));
			
				$result=mysql_query("select * from notification where id='$id'");
			
				
			if(mysql_num_fields($result))
			{
				$row=mysql_fetch_array($result);
				echo '<div>';
				echo '<h2 style="text-align:left;" class="views"><span class="left">Title: '.$row['title'].'</span><span class="right views">Views:'.$row['views'].'</span>'."&nbsp".'</h2>';
				echo '</div></div>';
				echo '<div id="modal-body" class="modal-body">';
					
				echo '<p></p>';
				echo '<p>'. $row['matter'].'</p>';
				if($row['file'])
				{
					echo '<br><a style="font-size:20px" href="upload/'.$row['file'].'" download="upload/'.$row['file'].'">Click for attachment</a>';
					echo '<br>';
				}
				echo '</div>';
				echo '<div class="modal-footer lblue" >';
				$date=$row["date"];
				echo '<h3 class="mm"><span class="left">Date:&nbsp;'.$date."&nbsp;&nbsp;".$row["time"]."";
				echo '</span>&nbsp;&nbsp;&nbsp;<span class="right">Send by:: ADMIN</span></h3>';
			}
			else
			{
				echo 'Nothing';
			}
			echo '</div>';
		echo '</div>';
	?>
</body>
</html>
