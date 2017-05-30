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
		<link rel="stylesheet" href="../css/style.css">
	</head>
<body>
	<br>
	<center>
		<div class="form"><br>
			<form method="post">
				<h3 class="blue">Edit Profile</h3>
				<input type="password" name="password" placeholder="Old Password">
				<br><br>
				<input type="password" name="password1" placeholder="New Password">
				<br><br>
				<input type="password" name="password2" placeholder="Re Enter Password">
				<br><br>
				<input type="submit" name="submit">
				<br><br>
			</form>
		</div>
</center>
<?php
	
?>
</body>
</html>
