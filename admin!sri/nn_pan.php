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
		<title>Notification Panel</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">		
		<link rel="stylesheet" type="text/css" href="../css/notification_style.css">
		<link rel="stylesheet" type="text/css" href="../css/table_style.css">
		<link rel="stylesheet" href="../css/modal.css">
		<script type="text/javascript" src="../js/modal.js"></script>
		<script type="text/javascript" src="js/ram2.js"></script>
	</head>
<body>
<?php
	
		require "../requires/connect.php";
		echo '<center>';
		echo '<span class="titl">Notification Panel</span>';
		echo '<table width="100%">';
		echo '<tr class="th"><th style="width:3%">S.No</th><th style="width:40%">Title</th><th style="width:10%">File</th><th>Class</th><th>Subject</th><th style="width:5%">Date</th><th>Edit</th><th>Hide</th><th>Delete</th></tr>';
		$id=1;
		$result=mysql_query("select * from notification order by id desc");
			while($data=mysql_fetch_assoc($result))
			{
				if($id%2==0)
				{
					echo '<tr class="even">';
				}
				else
				{
					echo '<tr class="odd">';
				}
					echo '<td>'.$data['id'].'</td><td><a href="javascript:void(0)" onClick='."'my(".$data['id'].")'".'>';
					echo $data['title'].'</a></td>';
					if($data['file'])
						{
							echo '<td><a href="../upload/'.$data['file'].'" target="_blank">'.$data['file'].'</a></td>';
						}else
						{
							echo '<td>---</td>';
						}
					
					echo '<td>'.$data['class'].'</td><td>'.$data['subject'].'</td>';
					$a=strtotime($data['date']);
					echo '<td>'.date("d-m-Y h:i:sa",$a);
					echo '</td><td><a href="notification_edit.php?id='.$data['id'].'"target="_balnk">Edit</a></td>';
					if($data['visibility']=='visible')
					{
						echo '<td><a href="#" onClick="hide('.$data['id'].",'notification'".')">Hide</a></td>';
					
					}
					else
					{
						echo '<td><a href="#" onClick="unhide('.$data['id'].",'notification'".')">UnHide</a></td>';
					}
					echo '<td id="del">';
					echo '<a href="#" onClick="del('.$data['id'].",'notification'".')" >Delete</a></td></tr>';
				$id++;
			}
			echo '</table>';
			echo '</center>';
			mysql_close($connection);
	?>
	<div><div id="myModal" class="modal">
</body>

</html>
