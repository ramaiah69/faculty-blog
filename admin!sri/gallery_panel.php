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
		<title>Gallery Panel</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">		
		<link rel="stylesheet" type="text/css" href="../css/notification_style.css">
		<link rel="stylesheet" type="text/css" href="../css/table_style.css">
		<script type="text/javascript" src="js/ram2.js"></script>
	</head>
<body>
<?php
	
		require "../requires/connect.php";
		echo '<center>';
		echo '<span class="titl">Gallery Panel</span>';
		echo '<table width="100%">';
		echo '<tr class="th"><th style="width:3%">S.No</th><th style="width:35%">File</th><th width="style:width:20%">Description</th><th style="width:15%">Date</th><th>Edit</th><th style="width:5%">Hide</th><th>Delete</th></tr>';
		$id=1;
		$result=mysql_query("select * from gallery order by id desc");
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
				echo '<td>'.$id.'</td>';	
					if($data['file'])
						{
							echo '<td><a href="../img/'.$data['file'].'" target="_blank">'.$data['file'].'</a></td>';
						}else
						{
							echo '<td>---</td>';
						}
					echo '<td>'.$data['description'].'</td>';
					echo '<td>'.$data['date']."&nbsp;&nbsp;";
					echo $data['time'];
					echo '</td><td><a href="gallery_edit.php?id='.$data['id'].'"target="_balnk">Edit</a></td>';
					if($data['visibility']=='visible')
					{
						echo '<td><a href="#" onClick="hide('.$data['id'].",'gallery'".')">Hide</a></td>';
					}else if($data['visibility']=='hidden'){
						echo '<td><a href="#" onClick="unhide('.$data['id'].",'gallery'".')">Unhide</a></td>';
					}
					echo '<td id="del">';
					echo '<a href="#" onClick="del('.$data['id'].",'gallery'".')" >Delete</a></td></tr>';
				$id++;
			}
			echo '</table>';
			echo '</center>';
			mysql_close($connection);
	?>
</body>
</html>
