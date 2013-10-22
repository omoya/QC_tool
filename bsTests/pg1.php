<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="ico/favicon.png">
		<script src="form.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

		<title>Navbar Template for Bootstrap</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="navbar.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="../../assets/js/html5shiv.js"></script>
		  <script src="../../assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>

    <div class="container">
	
		<!-- Static navbar -->
		<div class="navbar navbar-default">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">QC Tool</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#submit">Submit</a></li>
					<li><a href="#improve">Improve</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>

		<!-- Main component for a primary marketing message or call to action -->
		<div class="jumbotron" style = "width:49%;float:left;padding-right:10px;padding-left:10px;";>
			<form class="form-group" name="Form1" method="POST">	
				<table border="0" style="width: 100%;">
					<thead>
						<tr>
							<th>Pubmed URL</th>
							<th>Keywords</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<input type="text" name="url1" />
							</td>
							<td>
								<input type="text" name="keywords1" />
							</td>
							<td>
								<input type="submit" value="Check" name="check1" onclick="checkPmid(this.form.url1.value,this.form.keywords1.value); return false;">		
							</td>						
						</tr>
						<tr>
							<td>
								<input type="text" name="url2" />
							</td>
							<td>
								<input type="text" name="keywords2" />
							</td>
							<td>
								<input type="submit" value="Check" name="check2" onclick="checkPmid(this.form.url2.value,this.form.keywords2.value); return false;">
							</td>
						</tr>
						<tr>
							<td>
								<input type="text" name="url3" />
							</td>
							<td>
								<input type="text" name="keywords3" />
							</td>
							<td>
								<input type="submit" value="Check" name="check3" onclick="checkPmid(this.form.url3.value,this.form.keywords3.value); return false;">
							</td>
						</tr>
					</tbody>
				</table>
				<br>
				<input class="btn btn-lg btn-primary" type="submit" value="SUBMIT &raquo" name="submit" onclick="subm(this.form.url1.value,this.form.keywords1.value,this.form.url2.value,this.form.keywords2.value,this.form.url3.value,this.form.keywords3.value); return false;">	
			</form>  
			</p>
		</div>
		<div class="jumbotron" id="txtHint" style = "width:49%;float:right;font-size:16px;padding-right:10px;padding-left:10px;";>
		</div>
    </div> <!-- /container -->
	</body>	
	</div>
		<footer>
			<p>&copy; medBiomarkers 2013</p>
		</footer>
	</div><!-- /.container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src=".js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</html>

<script>
//This function calls the method that retrieves the PMID related data
//Currently it only admits numeric PMIDS input
//TODO: include pmid validation, short and ling url processing
function checkPmid(str, str2)
{
if (str.length==0)
  { 
  document.getElementById("txtHint").innerHTML="";
  return;
  }
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
	document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
	//Parses the response of the php function.
	var JSONResponse = JSON.parse(xmlhttp.responseText);
	//Create the string that will we displayed at the right column.
	right_column = "<b>PMID:</b> " + JSONResponse.pmid + "<br>" +
				   "<b>Keywords:</b>  " + JSONResponse.keywords + "<br>" +
				   "<b>Title:</b>  " + JSONResponse.title + "<br>" +
				   "<b>Abstract:</b>  " + JSONResponse.abstract;
	
	document.getElementById("txtHint").innerHTML = right_column;

    }
  }

// Calls the PHP function. Sends parameters via GET.
//xmlhttp.open("GET","retrieve_one.php?pmid="+str+"&kw="+ str2,true);
xmlhttp.open("GET","retrieve_one.php?pmid="+str+"&kw="+ str2,true);
xmlhttp.send();
}

function subm(str, str2, str3, str4, str5, str6)
{
if (str.length==0)
  { 
  document.getElementById("txtHint").innerHTML="";
  return;
  }
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
	//document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
	//Parses the response of the php function.
	var JSONResponse = JSON.parse(xmlhttp.responseText);
	sendit(JSONResponse);
	
	//Create the string that will we displayed at the right column.
	/*alert("PMID: " + JSONResponse.pmid + "<br>" +
				   "Keywords: " + JSONResponse.keywords + "<br><hr>" +
				   "Title: " + JSONResponse.title + "<br>" +
				   "Abstract: " + JSONResponse.abstract +
				   "PMID2: " + JSONResponse.pmid2 + "<br>" +
				   "Keywords2: " + JSONResponse.keywords2 + "<br><hr>" +
				   "Title2: " + JSONResponse.title2 + "<br>" +
				   "Abstract2: " + JSONResponse.abstract2 +
				   "PMID3: " + JSONResponse.pmid3 + "<br>" +
				   "Keywords3: " + JSONResponse.keywords3 + "<br><hr>" +
				   "Title3: " + JSONResponse.title3 + "<br>" +
				   "Abstract3: " + JSONResponse.abstract3 
				   );
				   */
	
	//document.getElementById("txtHint").innerHTML = right_column;

    }
  }

// Calls the PHP function. Sends parameters via GET.
xmlhttp.open("GET","retrieve_data.php?pmid="+str+"&kw="+str2+"&pmid2="+str3+"&kw2="+str4+"&pmid3="+str5+"&kw3="+str6,true);
xmlhttp.send();
}


//This function accepts a JSON as input. It will load the input data in Mongo as new documents
function sendit(json_input){
//Checks if the form has contents.
if (json_input.length==0)
  { 
  alert ("The form is empty, please fill it and check if values are valid before submitting");
  return;
  }
  
 //Create the request. The method depends of the browser running the code.
 if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  //Check if ready state changes. This happens when a call to the php file has been performed and the response arrives.
  xmlhttp.onreadystatechange=function()
  {
  //If the call was a success do this
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	//alert(xmlhttp.responseText);
	document.getElementById("insert").innerHTML = xmlhttp.responseText;
	//Opens a success message
	//alert("Data were successfully submitted");
    }
  }
  
//Performs the GET call
xmlhttp.open("GET","submit_pg1.php?id="+json_input.pmid + "&kw="+json_input.keywords + "&title="+json_input.title + "&abstract="+json_input.abstract + "&id2="+json_input.pmid2 + "&kw2="+json_input.keywords2 + "&title2="+json_input.title2 + "&abstract2="+json_input.abstract2 + "&id3="+json_input.pmid3 + "&kw3="+json_input.keywords3 + "&title3="+json_input.title3 + "&abstract3="+json_input.abstract3,true);
xmlhttp.send();
}
</script>































