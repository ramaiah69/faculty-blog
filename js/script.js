var xmlhttp;
	function call()
	{
		
		xmlhttp=getxmlobject();
		
		if(xmlhttp==null)
		{
			alert("Your browser doesnot support http");
		}
		else
		{
			var url='http://localhost/ss/profile.php';
			xmlhttp.open("GET",url,false);
			xmlhttp.send(null);
			document.getElementById("cc").innerHTML=xmlhttp.responseText;
		}
	}
	function load(str)
	{
		xmlhttp=getxmlobject();
		if(xmlhttp==null)
		{
			alert("Your browser doesnot support http");
		}
		else
		{	
			var url="materials.php?subject="+str;
			
			xmlhttp.open("GET",url,false);
			xmlhttp.send(null);
			document.getElementById("cc").innerHTML=xmlhttp.responseText;
		}
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
