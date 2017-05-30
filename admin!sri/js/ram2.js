
var xmlhttp;
		function hide(id,type)
		{
			var option=confirm("Confirm to hide");
			if(option==true)
			{
				xmlhttp=getxmlobject();
				var url="hide.php";
				url=url+"?id="+id+"&type="+type;
				xmlhttp.open("GET",url,false);
				xmlhttp.send(null);
				alert('Content Hidden');
				window.location.reload("admin_panel.php");
			}
		}
		function unhide(id,type)
		{
			var option=confirm("Confirm to Unhide");
			if(option==true)
			{
				xmlhttp=getxmlobject();
				var url="unhide.php";
				url=url+"?id="+id+"&type="+type;
				xmlhttp.open("GET",url,false);
				xmlhttp.send(null);
				alert('Content Unhidden');
				window.location.reload("admin_panel.php");
			}
		}
		function del(id,type)
		{
			var option=confirm("Confirm to Delete");
			if(option==true)
			{
				xmlhttp=getxmlobject();
				var url="del.php";
				url=url+"?id="+id+"&type="+type;
				xmlhttp.open("GET",url,false);
				xmlhttp.send(null);
				alert('Content Deleted');
				window.location.reload("admin_panel.php");
			}
		}
		function del2(id,type,year)
		{
			var option=confirm("Confirm to Delete");
			if(option==true)
			{
				xmlhttp=getxmlobject();
				var url="del.php";
				url=url+"?id="+id+"&type="+type+"&year="+year;
				xmlhttp.open("GET",url,false);
				xmlhttp.send(null);
				alert('Content Deleted');
				window.location.reload("admin_panel.php");
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
			return;
		}
		function ram()
		{
			
			xmlhttp=getxmlobject();
			url="nn_pan.php";
			xmlhttp.open("GET",url,false);
			xmlhttp.send(null);
			document.getElementById("iframe").src="nn_pan.php";
			
		}
		function rama()
		{
			xmlhttp=getxmlobject();
			url="article_panel.php";
			xmlhttp.open("GET",url,false);
			xmlhttp.send(null);
			document.getElementById("iframe").innerHTML=xmlhttp.responseText;
			
		}
		function post()
		{
			xmlhttp=getxmlobject();
			var url="post.php";
			xmlhttp.open("GET",url,false);
			xmlhttp.send(null);
			document.getElementById("main_body").innerHTML=xmlhttp.responseText;;
		}
		function update_solved(id)
		{
			var option=confirm("Confirm to update as solved");
			if(option==true)
			{
				xmlhttp=getxmlobject();
				var url="problem_solve.php?id="+id;
				xmlhttp.open("GET",url,false);
				xmlhttp.send(null);
				alert("Solved");
				window.location.reload("admin_panel.php");
			}
		}
