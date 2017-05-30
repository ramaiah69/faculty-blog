<!DOCTYPE html>
<html>
	<link rel="shortcut icon" href="images/rgu.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
* {box-sizing:border-box}
body {font-family: Verdana,sans-serif;margin:0}

/* Slideshow container */
.slideshow-container {
  max-width: 800px;
  background-color:#CCCCCC;
  position: relative;
  margin: auto;
}
img
{
	width:relative;
	height:400px;
}
/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 0;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: white;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
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
<body>

<div class="slideshow-container" style="max-height:600px;over-flow:hidden;">
	<center>
	<?php
		require "requires/connect.php";
		$query=mysql_query("select * from gallery");
		$id=1;
		$count=mysql_query("select count(*) from gallery");
		$count=mysql_fetch_array($count);
		$count=$count[0];
		while($data=mysql_fetch_assoc($query))
		{
			echo '<div class="mySlides fade">';
			echo '<div class="numbertext">'.$id.'/'.$count.'</div>';
			echo '<img src="img/'.$data['file'].'" style="">';
			echo '<div class="text">'.$data['description'].'</div>';
		}
	echo '</center>';
	
	echo '<a class="prev" style="float:left" onclick="plusSlides(-1)"><</a>';
	echo '<a class="next" onclick="plusSlides(1)">></a>';

	echo '</div>';
	
	echo '<br>';
	$id=1;
	echo '<div style="text-align:center">';
	
	echo '<span class="dot" onclick="currentSlide(1)"></span> ';
	  echo '<span class="dot" onclick="currentSlide(2)"></span> ';
	  echo '<span class="dot" onclick="currentSlide(3)"></span> ';
	  
?>
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
</script>

</body>

<!-- Mirrored from www.w3schools.com/howto/tryit.asp?filename=tryhow_js_slideshow by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 13 Mar 2016 11:03:55 GMT -->
</html> 

