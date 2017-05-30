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
		<title>Subjects panel</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">		
		<link rel="stylesheet" type="text/css" href="../css/notification_style.css">
		<link rel="stylesheet" type="text/css" href="../css/table_style.css">
		<script type="text/javascript" src="js/ram2.js"></script>
	</head>
	<body>
		<center>
		<span class="titl">Assignments</span>
		<?php
			$id=1;
			
		
				echo '<table class="notify_table" style="width:70%">';
				echo '<tr><th style="width:5%;">S.No</th><th style="width:80%">Title</th><th>Rename</th><th style="text-align:center;">Delete</th></tr>';
				
						require "../requires/connect.php";
						$query=mysql_query("select * from subject order by year desc");
						while($data=mysql_fetch_assoc($query))
						{
								if($id%2==0)
								{
									echo '<tr class="even">';
								}
								else
								{
									echo '<tr class="odd">';
								}
								
								echo '<td>'.$id.'</td><td class="bold">'.$data['subject'].'</td><td><a href="rename.php?subject='.$data['subject'].'" target="_blank">Rename</a></td><td class="underline"><a href="javascript:void:(0)" onClick="del('.$data['sid'].",'subject'".')" >Delete</a></td>';
								echo '</tr>';
								$id++;
						}
				echo '</table>';
			
		?>
</center>
	</body>
</html>



