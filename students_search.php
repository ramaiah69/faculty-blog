<?php
	if(!empty($_GET['batch']) && !empty($_GET['year']))
	{
		require "requires/connect.php";
		require "requires/functions.php";
		$batch=mysql_real_escape_string(test_input($_GET['batch']));
		$year=mysql_real_escape_string(test_input($_GET['year']));
		$array=mysql_query("select * from $batch where year='$year'");
		if(mysql_num_rows($array)==0)
		{
			echo 'There is no students.';
		}
		else if($batch!='phd' && $batch!='PHD')
		{
			echo '<span class="titl" style="font-size:30px;">'.strtoupper($batch).'-'.$year.'</span>'.'<br><br>';
			echo '<table class="notify_table" style="width:70%">';
			echo '<tr><th style="width:10%;">S.No</th><th style="width:25%">Id.No</th><th style="width:45%">Name</th>';
				$id=1;
				while ($data=mysql_fetch_assoc($array))
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
				
					echo '><td>'.$id.'</td><td class="bold">'.$data['id'].'</td><td>'.$data['name'].'</td>';
					echo '</tr>';
					$id++;
				}

			echo '</table>';
			echo '<br>';
		}
		else
		{
			echo '<span class="titl" style="font-size:30px;">'.strtoupper($batch).'-'.$year.'</span>'.'<br><br>';
			echo '<table class="notify_table" style="width:70%">';
			echo '<tr><th style="width:10%;">S.No</th><th style="width:60%">Name</th>';
				$id=1;
				while ($data=mysql_fetch_assoc($array))
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
				
					echo '><td>'.$id.'</td><td>'.$data['name'].'</td>';
					echo '</tr>';
					$id++;
				}

			echo '</table>';
			echo '<br>';
		}
		mysql_close($connection);
	}
	else if(empty($_GET['batch']))
	{
		echo 'Select a batch';
	}
	else{
		echo 'Select a Year';
	}
?>
