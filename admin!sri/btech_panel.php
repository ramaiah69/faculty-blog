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
		<script>
		function ka()
		{
			alert('s');
		}
		</script>
		<title>Btech panel</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">		
		<link rel="stylesheet" type="text/css" href="../css/notification_style.css">
		<link rel="stylesheet" type="text/css" href="../css/table_style.css">
		<script type="text/javascript" src="js/ram2.js"></script>
	</head>
	<body>
<?php

	
		require "../requires/connect.php";
		echo '<center>';
		echo '<span class="titl">Btech Panel</span>';
		echo '<table >';
		echo '<tr class="th"><th style="width:3%">S.No</th><th style="width:10%">Id</th><th style="width:40%">Name</th><th>Year</th><th>Edit</th><th>Delete</th></tr>';
		$id=1;
		$query=mysql_query("select * from  btech");
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
						echo '<td>'.$id.'</td><td>'.$data['id'].'</td><td>'.$data['name'].'</td><td>'.$data['year'].'</td>';
						echo '<td><a href="student_edit.php?id='.$data['id'].'&type=btech&year='.$data['year'].'" target="_blank">Edit</a></td>';
						echo '<td id="del">';
						echo '<a href="#" onClick="del2('."'".$data['id']."','btech',".$data['year'].')" >Delete</a></td></tr>';
						//echo '<a href="#" onClick="del2('.$data['id'].",'btech'".')">Delete</a></td></tr>';

				$id++;
			}
			echo '</table>';
			echo '</center>';
			mysql_close($connection);
	?>
	</body>
</html>


