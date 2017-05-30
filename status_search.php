<?php
	if(!empty($_GET['id']))
	{
	
		require "requires/connect.php";
		require "requires/functions.php";
		//getting data from post
		$id=mysql_real_escape_string(test_input($_GET['id']));
		
		$array=mysql_query("select * from problem where sendby='$id' order by id desc");
		if(mysql_num_rows($array)==0)
		{
			echo 'There is no problems.';
		}
		else
		{
			$id=1;
			echo '<span class="titl" style="font-size:30px;">Problem Status</span>'.'<br><br>';
			echo '<table class="notify_table" style="width:70%">';
			echo '<tr><th style="width:5%;">S.no</th><th style="width:30%">Description</th><th>Reply</th></tr>';
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
					
					echo '><td class="">'.$id.'</td><td>'.$data['description'].'</td>';
					if($data['reply'])
					echo '<td>'.$data['reply'].'</td></tr>';
					else
					echo '<td>No reply</td>';
					$id++;
			}
			
			echo '</table>';
			echo '<br><br>';
		}
		mysql_close($connection);
	}
	
	else
	{
		echo 'Enter id';
	}
?>


