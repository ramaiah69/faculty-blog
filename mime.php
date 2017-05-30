<?php
	$dir='software/';
	if(is_dir($dir))
	{
		if($dh=opendir($dir))
		{
			while($rr=readdir($dh))
			{
				if($rr=="." || $rr==".." || $rr=="index.php")
				{
					
				}else
				{
					require "../../php/PEAR/PHP/Compat/Function/mime_content_type.php";
					echo mime_content_type($rr);
				}
			}	
		}
	}mime_type();
?>
