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
		<style>
			tr
			{
					white-space: normal;
			}
			td
			{
				white-space: normal;
			}
			th,td
			{
				white-space:normal;
				max-width:200px;
				word-break: break-all;
			}
			
		</style>
		<title>Queris</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">		
		<link rel="stylesheet" type="text/css" href="../css/notification_style.css">
		<link rel="stylesheet" type="text/css" href="../css/table_style.css">
		<script type="text/javascript" src="js/ram2.js"></script>
	</head>
<body>
<?php
	
		require "../requires/connect.php";
		echo '<center>';
		echo '<table style="width:100%">';
		echo '<tr class="th"><th style="width:4%">S.No</th><th style="width:7%">Type</th><th style="white-space:normal">Description</th><th style="width:7%">Send By</th><th style="width:7%">Class</th><th style="width:14%">Date</th><th>Status</th><th>Delete</th><th style="width:20%">Reply</th></tr>';
		$id=1;
		$query=mysql_query("select * from problem order by id desc");
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
						echo $data['problem_type'].'</td>';
						echo '<td>'.$data['description'].'</td>';		
						echo '<td>'.$data['sendby'];
						echo '<td>'.$data['class'].'</td>';
						echo '<td>'.$data['date']."&nbsp;&nbsp;".$data['time'].'</td>';
						if($data['status']=='unsolved')
						{
							echo '<td><a href="javascript:void(0)" onClick="update_solved('.$data['id'].')">Pending</a></td>';
						}else
						{
							echo '<td><a href="javascript:void(0)">Solved</a></td>';
						}
						
						echo '<td id="del">';
						echo '<a href="#" onClick="del('.$data['id'].",'query'".')" >Delete</a></td>';
						if($data['reply'])
						{
							echo '<td>'.$data['reply'].'<br><a href="queryreply.php?id='.$data['id'].'" target="_blank">Edit</a></td>';
						}
						else
						{
							echo '<td><a href="queryreply.php?id='.$data['id'].'" target="_blank">Reply</a></td>';
						}
						echo '</tr>';
				$id++;
			}
			echo '</table>';
			echo '</center>';
		mysql_close($connection);
	?>
	</body>
</html>



