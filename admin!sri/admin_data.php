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
		<title>Admin</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">		
		<link rel="stylesheet" type="text/css" href="../css/notification_style.css">
		<link rel="stylesheet" type="text/css" href="../css/table_style.css">
		<script type="text/javascript" src="js/ram2.js"></script>
	</head>
<body>
<?php
	
		require "../requires/connect.php";
		echo '<center>';
		echo '<span class="titl">Admin data</span>';
		echo '<table width="100%">';
		echo '<tr class="th"><th style="width:3%">S.No</th><th style="width:30%">Ip</th><th style="width:30%">Mac</th><th>Date</th><th>Time</th></tr>';
		$id=1;
		$result=mysql_query("select * from admin_data order by date and time desc");
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
					echo '<td>'.$data['ip'].'</td>';
					echo '<td>'.$data['mac'].'</td>';
					
					echo '<td>'.$data['date'].'</td>';
					echo '<td>'.$data['time'].'</td>';
					
					echo '</tr>';
				$id++;
			}
			echo '</table>';
			echo '</center>';
			mysql_close($connection);
	?>
</body>
</html>

