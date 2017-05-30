
<?php
//finding mac address

function mac_address($ip)
{
	$mac=false;
	//run the external command, break output into lines
	$arp=`arp -a $ip`;
	$lines=explode("\n", $arp);
	//look for the output line describing our IP address
	foreach($lines as $line)
	{
	   $cols=preg_split('/\s+/', trim($line));
	   if ($cols[0]==$ip)
	   {
		   $mac=$cols[1];
	   }
	}
return $mac;
}
?>
