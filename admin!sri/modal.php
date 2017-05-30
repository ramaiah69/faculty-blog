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
		padding: 30px 20px;
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
		require "../requires/connect.php";
		require "../requires/functions.php";
		$id=test_input(mysql_real_escape_string(test_input($_GET['id'])));
		$type=test_input(mysql_real_escape_string(test_input($_GET['type'])));
		echo '<div class="modal-content">';
		echo '<center ><span class="titl" style="font-size:20px;font-family:verdana;color:red">';
		if($type=='article') 
			echo 'Publications';
		else
			echo 'Research';
		echo '</span></center>';
		echo '<div class="modal-header">';
			
			
			if(!empty($id) && !empty($type))
			{
				
				if($type=='article')
				{
					$type2=test_input(mysql_real_escape_string(test_input($_GET['type2'])));
					$result=mysql_query("select * from article where id='$id' and type='$type2'");
					
						
					if(mysql_num_fields($result))
					{
						$row=mysql_fetch_array($result);
						echo '<div class="">';
						echo '<h2 style="text-align:left;margin-top:-25px;" class="views"><span class="left">Title: '.$row['title'].'</span></h2>';
						echo '</div></div>';
						echo '<div id="modal-body" class="modal-body">';
							
						echo '<p></p>';
						echo '<p>'. $row['description'].'</p>';
						if($row['file'])
						{
							echo '<br><a style="font-size:20px" href="../upload/'.$row['file'].'" download="../article/'.$row['file'].'">Click for attachment</a>';
							echo '<br>';
						}
						echo '</div>';
						echo '<div class="modal-footer lblue" >';
						$date=$row["date"];
						echo '<h3 class="mm"><span class="left">Date:&nbsp;'.$date."&nbsp;&nbsp;".$row["time"]."";
						echo '</span>&nbsp;&nbsp;&nbsp;<span class="right">Send by:: ADMIN</span></h3>';
						echo '</div>';
					}
				}
				else if($type=='research')
				{
					
					
					$result=mysql_query("select * from research where id='$id'");
					echo '<div class="">';
					$row=mysql_fetch_array($result);
					
					
					echo '<h2 style="text-align:left;margin-top:-25px;" class="views"><span class="left">Title: '.$row['title'].'</span></h2>';
					echo '</div></div>';
					echo '<div id="modal-body" class="modal-body">';
						
					echo '<p></p>';
					echo '<p>'. $row['description'].'</p>';
					if($row['file'])
					{
						echo '<br><a style="font-size:20px" href="../research/'.$row['file'].'" download="'.$row['file'].'">Click for attachment</a>';
						echo '<br>';
					}
					echo '</div>';
					echo '<div class="modal-footer lblue" >';
					$date=$row["date"];
					echo '<h3 class="mm"><span class="left">Date:&nbsp;'.$date."&nbsp;&nbsp;".$row["time"]."";
					echo '</span>&nbsp;&nbsp;&nbsp;<span class="right">Send by:: ADMIN</span></h3>';
					echo '</div>';
				}
				else
				{
					echo 'Nothing';
				}
					
				}
			else
			{
				echo 'fill details without empty';
			}
		echo '</div>';
	?>
</body>
</html>
