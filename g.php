<html>
<head>
	<link rel="shortcut icon" href="images/rgu.ico">
	<meta charset="utf-8">
<meta name="Keywords" content="Assistant Professor">
<meta name="Description" content="">
<title>Gallery</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/public.css">
	<script type="text/javascript" src="js/height.js">	
	</script>
<style>

body {}

/* Slideshow container */
.slideshow-container {
	
  max-width: 700px;
  background-color:transperent;
  position:relative;
  margin: auto;
}
img#gal
{
	max-width:700px;
	width:relative;
	height:360px;
}
/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 0;
  top:50%;
  /*margin-top:500px;*/
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: black;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
}

/* Position the "next button" to the right */
.next {
	position:absolute;
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
	background-color:black;
	
font-family:arial;
  color: white;
  font-weight:bold;
  font-size: 14px;
  margin-top:10px;
  padding-bottom:10px;
  bottom: 8px;
  width: 80%;
  text-align: center;
  white-space:normal;
  word-break:break-all;
  padding:4px;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #BCBCBC;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor:pointer;
  height: 13px;
  width: 13px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .slprev, .slnext,.text {font-size: 11px}
}
</style>
<body onload="height_set()">
		<div class="main">
			<?php include "main_header.php";?>
		</div>
		<div class="header" style="background-color:black">
			<?php include "head.php";?>
		</div>
		
		<div class="cc" id="cc" style=" background-color:#ECECEC;">	
			<div style="dom">		
				<br>
				<div class="slideshow-container" style="max-height:600px;over-flow:hidden;">
					<center>
					<?php
					require "requires/connect.php";
						$query=mysql_query("select count(*) from gallery");
						$r=mysql_fetch_array($query);
						$count=$r[0];
						$i=1;
						$query=mysql_query("select * from gallery");
					
						if(mysql_num_rows($query))
						{
							while($data=mysql_fetch_assoc($query))
							{
								echo '<div class="mySlides fade">';
								 // echo '<div class="numbertext">'.$i.' / 3</div>';
								  echo '<img id="gal" src="img/'.$data['file'].'" style="" class="">';
								  echo '<div class="text">'.$data['description'].'</div>';
								echo '</div>';
								$i++;
							}
							echo '</center>';
							echo '<a class="prev" style="float:left" onclick="plusSlides(-1)"><</a>';
							echo '<a class="next" onclick="plusSlides(1)">></a>';
							echo '</div>';
							
						}else
						{
								echo 'There is no images.';
						}
					?>
					
					<br>
					<center>
					
					</center>
					<br>
					<center>
						<div style="margin-top:-17px;text-align:center">
						<?php
						$i=1;
						 while($i<=$count) 
						 {
							echo '<span class="dot" onclick="currentSlide('.$i.')"></span>';
							$i++;
						 }
						  ?>
						  <br><br>
						</div>
					</center>
				</div>
			</div>
		</div>
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length} ;
  for (i = 0; i < slides.length; i++) {
     slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
     dots[i].classList.remove("active");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].classList.add("active");
}
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
    setTimeout(carousel, 3000);    
}
</script>
</div></div>
		<div id="bottomContainer">
			<?php include "footer.php"; ?>
		</div>
	</div>
</body>

<!-- Mirrored from www.w3schools.com/howto/tryit.asp?filename=tryhow_js_slideshow by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 13 Mar 2016 11:03:55 GMT -->
</html> 
