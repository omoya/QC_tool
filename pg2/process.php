<html lang="en-US">

<head>
	<title>QC page 3</title>

	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<!--  	
		<style>
			body {background-color:#e5eecc;}
		</style>
	-->	
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	
	<script type="text/javascript">
		function onbutton(clicked_id)
		{
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			document.getElementById("abstractdisplay").innerHTML=xmlhttp.responseText;
			}
		  }  
		  
		var x = "url["+ clicked_id + "]";  
		var hello = document.getElementById(x).value;
		xmlhttp.open("GET","form_check.php?w1="+hello,true);
		xmlhttp.send();
		}
	</script>

</head>

<body>

	<div id="header">
		<h1>Fill the form with data from the abstract</h1>
	</div>
	
	<div id="nav"></div>

	<div id="content">
		<div id="main">
			<form name="test" method="POST">
				<div class="CSSTableGenerator" >
					<table border="0">
						<thead>
							<tr>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<label for="BMname">Biomarker Name:</label>
									<input id="url[1]" name="url[]"  type="text"   />
								</td>
							</tr>
							<tr>
								<td>
									<label for="BMassociated">Biomarker associated with [keywords]:</label>
									<input id="url[2]" name="url[]"  type="text"   />
								</td>
							</tr>
							<tr>
								<td>
									<label for="summary">Association Summary [why a biomarker]: </label>
									<input id="url[3]" name="url[]"  type="text"   />
								</td>
							</tr>
							<tr>
								<td>
									<label for="popNr">Total Population/ sample no: </label>
									<input id="url[3]" name="url[]"  type="text"   />
								</td>
							</tr>
							<tr>
								<td>
									<label for="popNotes">Population/ Sample Notes: </label>
									<input id="url[3]" name="url[]"  type="text"   />
								</td>
							</tr>
							<tr>
								<td>
									<label for="methods">Methods used [Biomarker Study]:   </label>
									<input id="url[3]" name="url[]"  type="text"   />
								</td>
							</tr>
							<tr>
								<td>
									<label for="results">Results (more detailed w. stats):     </label>
									<input id="url[3]" name="url[]"  type="text"   />
								</td>
							</tr>
							<tr>
								<td>
									<label for="species">Species:    </label>
									<input id="url[3]" name="url[]"  type="text"   />
								</td>
							</tr>
							<tr>
								<td>
									<label for="sample">Sample type:</label>
									<input id="url[3]" name="url[]"  type="text"   />
								</td>
							</tr>
							<tr>
								<td>
									<label for="molecule">Molecule Type:</label>
									<input id="url[3]" name="url[]"  type="text"   />
								</td>
							</tr>
							<tr>
								<td>
									<label for="moleculeSub">Molecule Subtype:</label>
									<input id="url[3]" name="url[]"  type="text"   />
								</td>
							</tr>
						</tbody>
					</table>
				</div>	
						<input type="submit" value="SUBMIT">
										
			</form>
		</div>

		<div id="sidebar">
			<p>Pubmed Title and Abstract appears here </p>
			<p><span id="abstractdisplay"></span></p>
		</div>

	</div>	

<div id="footer"></div>
   
</body>			

</html>