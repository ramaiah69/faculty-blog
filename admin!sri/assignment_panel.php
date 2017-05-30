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
		<title>assignment panel</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">		
		<link rel="stylesheet" type="text/css" href="../css/notification_style.css">
		<link rel="stylesheet" type="text/css" href="../css/table_style.css">
		<script type="text/javascript" src="js/ram2.js"></script>
	</head>
	<body>
<?php

	
		require "../requires/connect.php";
		echo '<center>';
		echo '<span class="titl">Assignemnts Panel</span>';
		echo '<table >';
		echo '<tr class="th"><th>S.No</th><th style="width:40%">Title</th><th>Subject</th><th>Class</th></th><th style="width="10%">File</th><th>Date </th><th>Edit</th><th style="width:5%">Visibility</th><th>Delete</th></tr>';
		$id=1;
		$query=mysql_query("select * from assignment  order by id desc");
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
						echo '<td>'.$data['id'].'</td><td>';
						echo $data['title'].'</td><td>'.$data['subject'].'</td><td>'.$data['class'].'</td>';
						if($data['file'])
						{
							echo '<td><a href="../assignment/'.$data['file'].'" target="_blank">'.$data['file'].'</a></td>';
						}else
						{
							echo '<td>---</td>';
						}
						$a=strtotime($data['date']);
						echo '<td>'.date("d-m-Y h:i:sa",$a);
						echo '</td><td><a href="assignment_edit.php?id='.$data['id'].'"target="_balnk">Edit</a></td>';
						if($data['visibility']=='visible')
						{
							echo '<td><a href="#" onClick="hide('.$data['id'].",'assignment'".')">Hide</a></td>';
						
						}
						else
						{
							echo '<td><a href="#" onClick="unhide('.$data['id'].",'assignment'".')">UnHide</a></td>';
						}
						echo '<td id="del">';
						echo '<a href="#" onClick="del('.$data['id'].",'assignment'".')" >Delete</a></td></tr>';

				$id++;
			}
			echo '</table>';
			echo '</center>';
			mysql_close($connection);
	?>
	</body>
</html>


