<style>
	.mySlides
	{
			max-width:500px;
			max-height:500px;
	}
	</style>
<?php
require "requires/connect.php";
$d=mysql_query('select * from gallery');
while($data=mysql_fetch_assoc($d))
{
	echo "<center>";
echo "<div class='mySlides' id='si1'>";
echo "<img onmouseover='ss()' style='width:500px;height:400px;' src='img/";
echo $data['file'];
echo "'style='width:100%'>";
echo '<div style="padding:10px;background-color:black;color:white;width:480px;margin-top:0px;border-radius:2px;text-align:center;">';
echo $data['description'];
echo '</div></div>';
echo "</center>";
	}
?>
<script>
var myIndex = 0;
carousel();

function carousel(id) 
{
	
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) 
    {
      x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000);    
}

</script>
