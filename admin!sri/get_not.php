
<?php
//Checking authority
	require "session_check.php";
	if($login_entry_status)	
		{}
	else
		header("location:login.php");
	if(!empty($_GET['id']) )
	{
		require "../requires/connect.php";
		require "../requires/functions.php";
		//getting data from post
		$id=mysql_real_escape_string(test_input($_GET['id']));
		$q=mysql_query("update notification set views=views+1 where id='$id'");
		$array=mysql_query("select * from notification where id='$id'");
		$query=mysql_fetch_array($array);
		if($query)
		{
				echo '<div class="modal-content" style="word-space:normal;word-break:break-all">';
				echo '<div class="modal-header">';
				 echo ' <span class="close" onClick="cls(this);">x</span>';
				 echo ' <p id="msg" style="font-size:17px;font-family:verdana;margin-left:-20px;font-weight:bold">'.$query['title'].'</p>';
				echo '</div>';
				echo '<div class="modal-body" style="min-height:100px;line-height:22px;">';
				 echo ' <p ">'.$query['matter'].'</p>';
				 echo '<br>';
				$file=$query['file'];
				if($file)
				{
						echo '<a style="font-size:14px;font-style:italic;font-weight:bold" href="upload/'.$file.'" download="'.$file.'">Click for attachment</a><br>';
				}
				echo '</div>';
				echo '<div class="modal-footer" style="padding:5px;height:40px;">';
				 echo ' <h3 style="left-size:10px;"><span class="left" style="margin-left:10px;font-size:14px;">To:&nbsp;'.$query['class']."&nbsp;&nbsp;&nbsp;&nbsp;Date: &nbsp;".$query['date']."&nbsp;&nbsp;".$query['time'].'</span><span class="right" style="font-size:14px;">Send by: Sreenadh</span></h3>';
			echo '</div>';
			echo '</div>';
		
		}

		mysql_close($connection);
	}
?>


