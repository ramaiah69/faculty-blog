<?php
	if(!empty($_GET['batch']) && !empty($_GET['year']))
	{
		require "requires/connect.php";
		require "requires/functions.php";
		//getting data from post
		$batch=mysql_real_escape_string(test_input($_GET['batch']));
		$year=mysql_real_escape_string(test_input($_GET['year']));
		$array=mysql_query("select * from project where batch='$batch' and year='$year' and visibility='visible'");
		if(mysql_num_rows($array)==0)
		{
			echo 'There is no projects under this categery.';
		}
		else
		{
			$id=1;
			echo '<span class="titl" style="font-size:30px;">'.strtoupper($batch).'-'.$year.'</span>'.'<br><br>';
			echo '<table class="notify_table" style="width:70%">';
			echo '<tr><th style="width:10%;">S.no</th><th style="width:80%">Title</th><th>Download</th></tr>';
			while($data=mysql_fetch_assoc($array))
			{
				echo '<tr';
					if($id%2==0)
					{
						echo ' class="even"';
					}
					else
					{
						echo ' class="odd"';
					}
				
					echo '><td class="bold">'.$id.'</td><td><a href="project/'.$data['file'].'" target="_blank">'.$data['title'].'</a></td><td><a href="project/'.$data['file'].'" download="'.$data['file'].'">Download</a></td></tr>';
			}
			echo '</table>';
			echo '<br>';
		}
		mysql_close($connection);
	}
	else if(empty($_GET['batch']))
	{
		echo 'Select a Batch';
	}
	else
	{
		echo 'Select a Year';
	}
?>

