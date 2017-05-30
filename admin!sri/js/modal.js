var xmlhttp;
	function my(id)
	{
		var modal = document.getElementById('myModal');

		// Get the button that opens the modal


		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks the button, open the modal 
			
		xmlhttp=getxmlobject();
		var url='get_not.php?id='+id;	
		xmlhttp.open("GET",url,false);
		xmlhttp.send(null);
		document.getElementById("myModal").innerHTML=xmlhttp.responseText;
		 modal.style.display = "block";

		// When the user clicks on <span> (x), close the modal
		function cls(v) {
			modal.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
		
	}
	function cls(v)
	{
		var modal = document.getElementById('myModal');
		modal.style.display = "none";
	}
	function getxmlobject()
	{
		if(window.XMLHttpRequest)
		{
			return new XMLHttpRequest;
		}
		if(window.ActiveXObject)
		{
			return new ActiveXObject("Microsoft.XMLHTTP");
		}
		return ;
	}
