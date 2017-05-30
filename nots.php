<div class="note bt left" id="nan" style=""><center>Notifications:</center>
</div>
<div class="note rt right" style="">
	<marquee behavior="scroll" scrollamount="6" direction="left" onmouseover="this.setAttribute('scrollamount',0);" onmouseout="this.setAttribute('scrollamount',6);">
		<?php
			require "requires/connect.php";
			$array=mysql_query("select * from notification where visibility='visible' order by id desc limit 6");
			$count=mysql_num_rows($array);
			$i=1;
			while($data=mysql_fetch_assoc($array))
			{	
				
					echo "<a style='text-decoration:none;color:#400000;font-size:14px;font-weight:900;font-family:arial;' href='javascript:void(0)' onClick='my(".$data['id'].")' onmouseover='this.stop();' onmouseout='this.start();'>";
					echo $data['title'];
					echo "</a> ";
					$a=strtotime($data['date']);
					
					if(date('Y-m-d')==date("Y-m-d",$a))
					{
							echo "<img  src='images/new.gif'>";
							
					}
					if($i!=$count)
						echo "&nbsp;&nbsp;|&nbsp;&nbsp;";
					$i++;
				}
			mysql_close($connection);
		?>
	</marquee>
</div>

