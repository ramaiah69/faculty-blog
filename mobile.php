<!DOCTYPE html>
<html lang="en-us">
<head>
	<link rel="shortcut icon" href="images/rgu.ico">
	<title>Home</title>
	<style>
		html{overflow-y:scroll}
		#cc{background-color:F8F8F8;}
		body{background-color:#BBBBBB;}
		.left{float:left}
		.right{float:right}
		.logo{height:20px;width:20px;}
		.title{font-size:13px;Color:white;font-weight:bold;}
		.title-small{font-size:11px;color:white;}
		.main{width:400px;background-color:#21638A;}
		.container{width:400px}
		.title2{font-size:20px;margin-left:5px;font-family:arial;color:#BBC8FF}
		.header{height:auto;min-height:30px;}
		.header a{color:white;}
		a{text-decoration:none;}
		header > ul , .dropdown-content > ul
{
	list-style:none;

	
}
.header > ul , .header2 > ul,.dropdown-content > ul
{
	list-style:none;
	padding:0;
	margin:0;
	overflow:hidden;
	
}
.header > ul >li,.header2 > ul > li
{
	display:inline-block;
}

.dropdown:hover .dropdown-content 
{
	display: block;
}
.dropdown2:hover .dropdown-content 
{
	display: block;
}
.dropdown-content
{
	display: none;
	position: absolute;
	background-color:#3F3F3F;

	
}	
.header >ul > li > a,.dropdown a
{
	display:block;
	background-color:transperant;
	padding:6px 5px 6px 7px;
	text-decoration:none;
	margin-left:2px;
	cursor:pointer;
	color:white;
	font-family:arial;
}
.dropdown2 a{display:block;
	background-color:transperant;

	text-decoration:none;
	margin-left:2px;
	cursor:pointer;
	color:white;
	font-family:arial;}
.header >ul > li > a:hover, .header> ul>li> a:focus,.dropdown > a:hover,.dropdown > a:focus
{

	background-color:#D1D1D1;
	color:black;
	
}
#cc
{
	background-color:F8F8F8;
}	
	</style>
</head>
<body>
	<div class="container">
		<div class="main">
			<span class="title right"> <img class="logo right" src="images/rgu.ico">RGUKT <sub><sub class="title-small">- Nuzvid&nbsp &nbsp</sub></sub></span>
			<br>
			<div class="title2" style="width:100%;height:30px">
				<span style="" class="main-title">SREENADH BLOG</span>
			</div>
		</div>
		<div class="header" style="background-color:black">
				<div class="header left">
					<ul>
					<li><a href="mobile.php" id="tth" title="Home">Home</a></li>
					<li>
						<div class="dropdown">
							<a href="#"  id="ttt" title="To select Teaching menu">Teaching</a>
							<div class="dropdown-content">
								<div class="dropdown-content">
									<ul>
										<li><a href="subject.php">Subject</a></li>
										<li><a href="assignment.php">assignment</a></li>
										<li><a href="result.php">result</a></li>
									</ul>
								</div>
							</div>
						</div>
					</li>
					
					<li><a href="notifications_view.php" id="ttno" title="notifications">Notifications</a></li>
					<a href="notifications_view.php" id="ttno" title="notifications">&nbsp;
							</ul></div>
					<div class="left header2">
						<ul>
							<li>
								<div class="dropdown2">
								<a href="#"><img style="margin-top:1px;" src="images/dropdown.png"></a>
								<div class="dropdown-content">
									<div class="dropdown-content">
										<ul>
											<li><a href="subject.php">Subject</a></li>
											<li><a href="assignment.php">assignment</a></li>
											<li><a href="result.php">result</a></li>
										</ul>
									</div>
								</div>
								</div>
										
							</li>
						</ul>
					</div>
		</div>
		<div class="cc" id="cc">
			<?php include "profile.php"?>
		</div>
	</div>
</body>
</html>
