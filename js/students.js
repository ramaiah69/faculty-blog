var xmlhttp;
	function load_std()
	{
		xmlhttp=getxmlobject();
		if(xmlhttp==null)
		{
			alert("Your browser doesnot support http");
		}
		else
		{	
			var batch=document.getElementById("type").value;
			var year=document.getElementById("year").value;
			var url="students_search.php?batch="+batch+"&year="+year;
			
			xmlhttp.open("GET",url,false);
			xmlhttp.send(null);
			document.getElementById("details").innerHTML=xmlhttp.responseText;
		}
	}
	function ram()
	{
		alert("chinni");
	}
	function load_project()
	{
		xmlhttp=getxmlobject();
		if(xmlhttp==null)
		{
			alert("Your browser doesnot support http");
		}
		else
		{	
			var batch=document.getElementById("batch").value;
			var year=document.getElementById("year").value;
			var url="projects_search.php?batch="+batch+"&year="+year;
			
			xmlhttp.open("GET",url,false);
			xmlhttp.send(null);
			document.getElementById("details").innerHTML=xmlhttp.responseText;
		}
	}
	function load_status()
	{
		xmlhttp=getxmlobject();
		if(xmlhttp==null)
		{
			alert("Your browser doesnot support http");
		}
		else
		{	
			var id=document.getElementById("id1").value;
			var url="status_search.php?id="+id;
			xmlhttp.open("GET",url,false);
			xmlhttp.send(null);
			document.getElementById("details").innerHTML=xmlhttp.responseText;
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

