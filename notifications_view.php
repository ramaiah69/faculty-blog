
<html lang="en">
<head>
	<title>Notifications</title>
	<link rel="stylesheet" href="css/style.css">	
	<link rel="stylesheet" href="css/table_style.css">
	<link rel="stylesheet" href="css/modal.css">
	<link rel="stylesheet" href="css/public.css">
	<script type="text/javascript" src="js/height.js"></script>
	<script type="text/javascript" src="js/modal.js">
	</script>
	<style>		
	#ttno
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
	
	<div class="cc" id="cc"><br>
		<div class="dom" style="min-height:40px">
			<center><span class="titl">Notifications</span></center>
				<center>
					
							<?php
								$id=1;
								require "requires/connect.php";
								$adataay=mysql_query("select * from notification where visibility='visible' order by id desc");
								if(mysql_num_rows($adataay))
								{
									echo '<table class="" style="width:95%">';
									echo '<tr><th style="width:4%;">Id</th><th style="width:68%">Title</th><th style="3%">Send To</th><th style="width:15%">DateTime</th><th width="5%">Views</th></tr>';
									while ($data=mysql_fetch_assoc($adataay))
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
										$a=strtotime($data['date']);
										echo '><td>'.$id.'</td><td><a id="myBtn" href="javascript:void(0)" onclick="my('.$data['id'].')">'.$data['title'].'</a>';
										if(date('Y-m-d')==date("Y-m-d",$a))
										{
												echo "&nbsp;&nbsp;&nbsp;<img  src='images/new.gif'>";
												
										}
										echo '</td><td>'.$data['class'].'</td><td>'.date("d-m-Y h:i:sa",$a).'</td><td>'.$data['views'].'</td>';
										echo '</tr>';
										$id++;
									}
								}else{
									echo '<br>There is no notifications.';
								}
								mysql_close($connection);
							?>
			
					</table>
				</center>
			<br><br>
		</div>
	</div>



<!-- The Modal -->


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
 

</div>
	
<script>

</script>

	<div></div>
	<div id="bottomContainer">
		<?php include "footer.php"; ?>
	</div>

</body>
</html>
