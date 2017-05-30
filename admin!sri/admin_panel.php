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
	<link rel="stylesheet" href="../css/admin.css">
	<!-- <script>
			setInterval(
				function ()
				{
					window.location.reload();
				},5000
			);
		</script>
	-->

<style>
<script>
	function delete(sub)
	{
		
	}
</script>
</style>
<!--	
<script>
	setInterval(
		function ()
		{
			window.location.reload();
		},5000
	);
</script>
-->
	
<script>
function frame_height(){
		var height=window.innerHeight;
		document.getElementById("iframe").style.minHeight=height*0.85;
		
	}
</script>
</head>
<body onLoad="frame_height()">
	<div class="head">
		<center>
			<ul id="nav">
				
				<li>
					<div class="dropdown">
						<a href="#" class="main2">Post</a>
						<div class="dropdown-content">
							<ul id="up">
								<li><a href="assignment_post.php" target="iframe">Assignment</a></li>
								<li><a href="notification_post.php" target="iframe">Notification</a></li>
								<li><a href="result_post.php" target="iframe">Result</a></li>
								<li><a href="article_post.php" target="iframe">Publications</a></li>
								<li><a href="research_post.php" target="iframe">Research</a></li>
							</ul>
						</div>
					</div>
				</li>
				<!--
				<li>
					<div class="dropdown">
						<a href="#">Delete</a>
						<div class="dropdown-content">
							<ul id="up">
								
								<li><a href="assignment_delete.php" target="iframe">Assignment</a></li>
								<li><a href="result_delete.php" target="iframe">Result</a></li>
								<li><a href="project_delete.php" target="iframe">Project</a></li>
							</ul>
						</div>
					</div>
				</li>
				-->
				<li>
					<div class="dropdown">
						<a href="#" class="main2" >Add</a>
						<div class="dropdown-content">
							<ul id="up">
								
								<li><a href="files_uploads.php" target="iframe">Files in subjects</a></li>
								<li><a href="student_add.php" target="iframe">Students</a></li>
								<li><a href="software_add.php" target="iframe">Software</a></li>
								<li><a href="subject_add.php" target="iframe">Subject</a></li>
								<li><a href="class_add.php" target="iframe">Class</a></li>
								<li><a href="project_add.php" target="iframe">Project</a></li>
								<li><a href="gallery_add.php" target="iframe">Gallery</a></li>
								
							</ul>
						</div>
					</div>
				</li>
				<li>
					<div class="dropdown">
						<a href="#" class="main2">Panels</a>
						<div class="dropdown-content">
							<ul id="up">	
								<li><a href="assignment_panel.php" target="iframe">Assignment</a></li>
								<li><a href="subject_panel.php" target="iframe">Subjects</a></li>
								<li><a href="nn_pan.php" target="iframe">Notifications</a></li>
								<li><a href="article_panel.php" target="iframe">Publications</a></li>
								<li><a href="result_panel.php" target="iframe">Result</a></li>
								<li><a href="research_panel.php" target="iframe">Research</a></li>
								<li><a href="project_panel.php" target="iframe">Project</a></li>
								<li><a href="gallery_panel.php" target="iframe">Gallery</a></li>
								
							</ul>
						</div>
					</div>
				</li>
				
				<li><a href="queries.php" class="main2" target="iframe">Queries (
				<?php
					require "../requires/connect.php";
					$query=mysql_query("select count(id) from problem where status='unsolved'");
					$result=mysql_fetch_array($query);
					echo $count=$result[0];
				?>
				)
				</a></li>
				<li><a href="current_sem.php" class="main2" target="iframe">Curent sem</a></li>
				<li>
					<div class="dropdown">
						<a href="#" class="main2">Other</a>
						<div class="dropdown-content">
							<ul id="up">	
								<li><a href="filetype_add.php" target="iframe">Check and add File type</a></li>
							</ul>
						</div>
					</div>
				</li>
				<li><a href="logout.php" class="main2">logout</a></li>
			</ul>
		</center>
	</div>
	<div class="body" style="padding:0;margin-top:-15px;">

		<div id="main_body">
			<iframe name="iframe" id="iframe" src="assignment_post.php" frameborder=0 width="100%" style="padding:0;min-height:460px;"></iframe>
		</div>
	<div><div id="myModal" class="modal">
	</div>
	
</body>
</html>
<?php
	mysql_close($connection);
?>

