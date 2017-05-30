<?php
	
?>
<html lang="en">
	
<head>
	<link rel="shortcut icon" href="images/rgu.ico">
	<title>subject</title>
	<link rel="stylesheet" href="css/style.css">	
	<link rel="stylesheet" href="css/table_style.css">
	<script type="text/javascript" src="js/height.js"></script>
	
	<style>		
		#ttt
		{
			border-top:4px solid #28B886;
			background-color:#E5E5E5;
			color:black;
		}
		td,tr
		{
			white-space:normal;
		}
			
	</style>
</head>
<body onLoad="height_set()">
	<div class="main">
		<?php include "main_header.php";?>
	</div>
	<div class="header" style="background-color:black">
		<?php include "head.php";?>
	</div>
	
	<div class="cc" id="cc"><br>
		<div class="dom">
			<a type="link" href="javascript:void(0)"  style="margin-left:20px;"onclick="goBack()">Back</a>
			<center>
				<?php
					$id=1;
						require "requires/functions.php";
						$subject=mysql_real_escape_string(test_input($_GET['subject']));
						
						echo '<span class="titl">'.$subject.'-Materials</span>';
						
						echo '<br>';
						
						$a=3;
						$dir="subject/$subject/materials";
						if(is_dir($dir))
							$a=scandir($dir);
						
						if(count($a)==3)
						{
							echo '<br>no files';
						}
						else
						{
							require "requires/connect.php";
							$type='materials';
							echo '<table class="notify_table" style="width:90%">';
							echo '<tr><th style="width:5%;">S.No</th><th style="width:60%">Title</th><th style="width:20%">Date & Time</th><th style=";width:15%">File</th></tr>';
							if(is_dir($dir))
							{
								if($dh=opendir($dir))
								{
									$query=mysql_query("select * from file where subject='$subject' and type='$type' order by date desc ");
									
									while($rr=mysql_fetch_assoc($query))
									{
										
										if($rr=="." || $rr==".." || $rr=="index.php")
										{
											
										}
										else
										{
											$a=strtotime($rr['date']);

											echo '<tr';
											if($id%2==0)
											{
												echo ' class="even"';
											}
											else
											{
												echo ' class="odd"';
											}
											
											echo '><td>'.$id.'</td><td class="bold">'.$rr['file'];
											if(date('Y-m-d')==date("Y-m-d",$a))
											{
													echo "&nbsp;&nbsp;&nbsp;<img  src='images/new.gif'>";
											}
											echo '</td><td>'.date("d-m-Y h:i:sa",$a).'</td><td style="text-align:center"><a class="underline" href="subject/'.$subject.'/materials/'.$rr['file'].'" download="'.$rr['file'].'">Download</a></td>';
											echo '</tr>';
											$id++;
										}
									}
								}
								closedir($dh);
							}
							echo '</table>';
						}
						echo '<br>';
						$id=1;
						$dir="subject/$subject/videos";
						$a=3;
						if(is_dir($dir))
							$a=scandir($dir);
						if(count($a)==3)
						{
							
						}
						else
						{
							require "requires/connect.php";
							$type='videos';
							echo '<br>';
							echo '<span class="titl">'.$subject.'-Videos</span>';
							echo '<table class="notify_table" style="width:90%">';
							echo '<tr><th style="width:5%;">S.No</th><th style="width:60%">Title</th><th style="width:20%">Date & TIme</th><th style=";width:15%">File</th></tr>';
							if(is_dir($dir))
							{
								if($dh=opendir($dir))
								{
									$query=mysql_query("select * from file where subject='$subject' and type='$type' order by date desc ");
									while($rr=mysql_fetch_assoc($query))
									{
										
										if($rr=="." || $rr==".." || $rr=="index.php")
										{
											
										}
										else
										{
											$a=strtotime($rr['date']);
											echo '<tr';
											if($id%2==0)
											{
												echo ' class="even"';
											}
											else
											{
												echo ' class="odd"';
											}
											echo '><td>'.$id.'</td><td class="bold">'.$rr['file'];
											if(date('Y-m-d')==date("Y-m-d",$a))
											{
													echo "&nbsp;&nbsp;&nbsp;<img  src='images/new.gif'>";
											}
											echo '</td><td>'.date("d-m-Y h:i:sa",$a).'</td><td style="text-align:center"><a class="underline" href="subject/'.$subject.'/videos/'.$rr['file'].'" download="'.$rr['file'].'">Download</a></td>';
											echo '</tr>';
											$id++;
										}
									}
									;
								}
								else
								{
									echo 'There is no directroy';
								}
								closedir($dh);
							}
							echo '</table>';
						}
					?>
				
			</center>
			<br><br>
		</div>
	</div>
	
	<div></div>
	<div id="bottomContainer">
		<?php include "footer.php"; ?>
	</div>

</body>
</html>

