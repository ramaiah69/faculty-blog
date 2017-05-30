<?php
	session_start();
	if(isset($_SESSION['RAMAIAH@user']) && isset($_SESSION['user@PVK']) && isset($_SESSION['BEYOND']))
	{
		$login_entry_status=true;
	}
	else
	{
		$login_entry_status=false;
	}
?>
