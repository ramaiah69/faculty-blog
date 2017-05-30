<ul>
	<li><a href="index.php" id="tth" title="Home">Home</a></li>
	<li>
		<div class="dropdown">
			<a href="#" class="border" id="ttt" title="To select Teaching menu">Teaching</a>
			<div class="dropdown-content">
				<div class="dropdown-content">
					<ul>
						<li><a href="subject.php">Subjects</a></li>
						<li><a href="assignment.php">Assignments</a></li>
						<li><a href="result.php">Results</a></li>
					</ul>
				</div>
			</div>
		</div>
	</li>
	<li>
		<div class="dropdown">
			<a href="#" id="ttpb" class="border" id="ttt" title="To select Publications">Publications</a>
			<div class="dropdown-content">
				<div class="dropdown-content">
					<ul>
						<li><a href="pub.php">Journals</a></li>
						<li><a href="pub2.php">Conferences</a></li>
						
					</ul>
				</div>
			</div>
		</div>
	</li>
	<li><a href="" id="ttee" title="EECC Lab">EECC Lab</a></li>
	<li><a href="research.php" id="ttre" title="Research">Research</a></li>
	<li><a href="project.php" id="ttpr" title="project">Projects</a></li>
	<li><a href="student.php" id="ttst" title="View students">Students</a></li>
	
	
	<!-- <li><a href="pub.php" id="ttpb" title="Publications">Publications</a></li> -->
	<li><a href="software.php" id="ttso" title="softwares">Softwares</a></li>
	<li><a href="notifications_view.php" id="ttno" title="notifications">Notifications<span style=""> <span style="color:red">
		(
		<?php
					require "requires/connect.php";
					date_default_timezone_set("Asia/Calcutta");
					$date=date("Y-m-d");
					$query=mysql_query("select count(id) from notification where date like '%$date%' and visibility='visible'");
					$result=mysql_fetch_array($query);
					echo $count=$result[0];
		?>
		)</span></span></a></li>
	<li><a href="g.php" id="ttga" title="Gallery">Gallery</a></li>
	<!--<li><a href="#" td="ttga" title="Gallery">Acknowledgement</a></li>-->
	<!--<li><a href="#" title="other">Other</a></li> -->
		
</ul>

