var xmlhttp;
	function loadsub(str)
	{
		
		xmlhttp=getxmlobject();
		
		if(xmlhttp==null)
		{
			alert("Your browser doesnot support http");
		}
		else
		{
		
			var url='sub.php?sub='+str;	
			xmlhttp.open("GET",url,false);
			xmlhttp.send(null);
			document.getElementById("ram").innerHTML=xmlhttp.responseText;
			
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

