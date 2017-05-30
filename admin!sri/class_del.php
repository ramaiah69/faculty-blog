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
		<title>Class Delete</title>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/notification_style.css">
		<style>
			input,select
			{
				width:50%;
			}
			
		</style>
	</head>
<body>
	<div>
		<center>
		<form method="post" class="form" enctype="multipart/form-data"><br>
		<h3 class="titl">Class Delete</h3><hr class="hr"><br>
		<?php
		require "../requires/connect.php";
		require "../requires/functions.php";
			
				
				
				echo '<select name="class" required title="Select class">';
					require "../requires/connect.php";
					$array=mysql_query("select * from class");
					echo '<option name="class" value="" >Select Class</option>';
					while($data=mysql_fetch_assoc($array))
					{
						echo '<option name="subject" value="'.$data['class'].'">'.$data['class'].'</option>';
					}
				echo "</select>";
				
				echo "<br><br> ";
				mysql_close($connection);
			
		?>
		<input type="submit" name="submit" value="submit"><br><br><br>
		</center>
	</div><br>
</body>
</html>
<?php
	if(isset($_POST['submit']))
	{
		if(!empty($_POST['class']) )
		{
			//getting data by post
				require "../requires/connect.php";
				$class=mysql_real_escape_string(test_input($_POST['class']));
				$r=mysql_query("delete from class where class='$class'");
				if($r)
				{
					echo '<script>window.alert("Class Deleted.")</script>';	
				}
				else
				{
					echo "Not";
				}
		}
	}

?>
 
