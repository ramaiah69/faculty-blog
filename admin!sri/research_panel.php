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
		<title>Research Panel</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">		
		<link rel="stylesheet" type="text/css" href="../css/notification_style.css">
		<link rel="stylesheet" type="text/css" href="../css/table_style.css">
		<script type="text/javascript" src="js/ram2.js"></script>
		
	</head>
	<style>
		th,td
		{
			white-space:normal;
			word-break:break-all;
		}
	</style>
<body>
	<?php

			require "../requires/connect.php";
			echo '<center>';
			echo '<span class="titl">Research Panel</span>';
			echo '<table style="width:100%">';
			echo '<tr class="th"><th style="width:5%">S.No</th><th style="width:40%">Title</th><th style="width:10%">Area</th></td><th style="width="10%">File</th><th style="width:15%">Date </th><th style="width:5%">Edit</th><th style="width:7%">Visibility</th><th style="width:5%">Delete</th></tr>';
			$id=1;
			$result=mysql_query("select * from research  order by id desc");
				while($row=mysql_fetch_assoc($result))
				{
					
						if($id%2==0)
						{
							echo '<tr class="even">';
						}
						else
						{
							echo '<tr class="odd">';
						}
							echo '<td>'.$row['id'].'</td><td><a href="modal.php?id='.$row['id'].'&type=research" target="_blank">';
							echo $row['title'].'</a></td><td>'.$row['area'].'</td>';
							if($row['file'])
							{
								echo '<td><a href="../research/'.$row['file'].'" target="_blank">'.$row['file'].'</a></td>';
							}else
							{
								echo '<td>---</td>';
							}
							echo '<td>'.$row['date']."&nbsp;&nbsp;";
							echo $row['time'];
							echo '</td><td><a href="research_edit.php?id='.$row['id'].'"target="_balnk">Edit</a></td>';
							if($row['visibility']=='visible')
							{
								echo '<td><a href="#" onClick="hide('.$row['id'].",'research'".')">Hide</a></td>';
							
							}
							else
							{
								echo '<td><a href="#" onClick="unhide('.$row['id'].",'research'".')">UnHide</a></td>';
							}
							echo '<td id="del">';
							echo '<a href="#" onClick="del('.$row['id'].",'research'".')" >Delete</a></td></tr>';

					$id++;
				}
			echo '</table>';
			echo '</center>';
		mysql_close($connection);
	?>
</body>
</html>

