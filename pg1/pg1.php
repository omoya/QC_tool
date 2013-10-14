<html>
<head>
<link rel="stylesheet" type="text/css" href="form.css">
<script src="form.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
</head>

<body>

<div id="main-wrap">	
<div id="sidebar">
		
<form name="Form1" method="POST">
	
		<table border="0">
			<thead>
				<tr>
					<th>Enter Pubmed URL:</th>
					<th>Associated with [Keywords]:</th>
				</tr>
			</thead>
			<tbody>

				<tr>
					<td>
						<label for="one">1</label>
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
						<label for="one">2</label>
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
						<label for="one">3</label>
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
<input type="submit" value="SUBMIT" name="submit" onclick="subm(this.form.url1.value,this.form.keywords1.value,this.form.url2.value,this.form.keywords2.value,this.form.url3.value,this.form.keywords3.value); return false;">	
	
</form>


</div>

	<div id="content-wrap">
		<span style="color:blue" id="output"></span>
		<span style="color:blue" id="txtHint"></span></p>
	</div>
	<div class="CSSTableGenerator">
	<span id="insert"></span>
	</div>
</div>	
</body>			

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

	//Parses the response of the php function.
	var JSONResponse = JSON.parse(xmlhttp.responseText);
	//Create the string that will we displayed at the right column.
	right_column = "PMID: " + JSONResponse.pmid + "<br>" +
				   "Keywords: " + JSONResponse.keywords + "<br><hr>" +
				   "Title: " + JSONResponse.title + "<br>" +
				   "Abstract: " + JSONResponse.abstract;
	
	document.getElementById("txtHint").innerHTML = right_column;

    }
  }

// Calls the PHP function. Sends parameters via GET.
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
xmlhttp.open("GET","submit_pg1.php?id="+json_input.pmid + "&kw="+json_input.kw + "&title="+json_input.title + "&abstract="+json_input.abstract + "&id2="+json_input.pmid2 + "&kw2="+json_input.kw2 + "&title2="+json_input.title2 + "&abstract2="+json_input.abstract2 + "&id3="+json_input.pmid3 + "&kw3="+json_input.kw3 + "&title3="+json_input.title3 + "&abstract3="+json_input.abstract3,true);
xmlhttp.send();
}
</script>



