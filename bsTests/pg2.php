<?php	
try {
	// open connection to MongoDB server
	//$conn = new Mongo('localhost:27017');
	$conn = new Mongo('mongodb://medb:medb2013medb@ds049548.mongolab.com:49548/medb');  

	// access database
	$db = $conn->medb;

	// access collection
	$collection = $db->dev3;
    
	// execute query
	// retrieve all documents
	$cursor = $collection->find();
	
// Echo the first HTML static lines
echo '  
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

		<title>QcTool</title>

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
					<li><a href="#">Home</a></li>
					<li><a href="#submit">Submit</a></li>
					<li class="active"><a href="#improve">Improve</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>	
	
		<div id="main-wrap">
		<i>
		';
			// Echo the number of documents retrieved
			//TODO: format the link as a button or similar.
			//Create a link to the file
echo '<small>'.$cursor->count() . ' document(s) found</i>&nbsp&nbsp';
echo '<a href="QCexport.csv">Export to CSV &nbsp<span class="glyphicon glyphicon-download"></span> </a></small>';


// Keep echoing the static HTML lines. Including table div opening and headers.
echo '
		</div>
		<div class="table-responsive">
			
			<table class="table table-striped">
		
		
					<tbody>
						<td style = "font-size:18px;"><b>PMID</b></td>
						<td style = "font-size:18px;"><b>Entry</b></td>
						<td style = "font-size:18px;text-align:center;"><b>Status</b></td>
						<td></td>';			
	
	//Intialize a counter. It will be used to give names to table elements dynamically
	$count = 0;
	//$csv_array = array();
	
	// Print each document in a table
	// Iterate through the result set
	// TODO: retrieve level from database. Need to create the routines to evaluate the level of an entry
	foreach ($cursor as $obj) {
		// Append data to the array that will be used to export data to CSV
		$csv_array[] = array($obj['submission']['publication']['PMID'],$obj['submission']['publication']['title'],$obj['submission']['publication']['abstract'],$obj['submission']['publication']['keywords']);
	// Increase by 1 the counter each iteration and convert to string
		$count = $count + 1;
		$count_str = strval($count);
echo '
				<tr>
					<td name= "pmid'.$count_str.'">';
echo
	$obj['submission']['publication']['PMID'].'</td>';
echo '						
					<td name= "entry'.$count_str.'">';
echo
	'<b>'.$obj['submission']['publication']['title'].'</b><br><br>

	'.$obj['submission']['publication']['abstract'].'<br><br>

	<i>'.$obj['submission']['publication']['keywords'].'</i></td>';
echo '
					<td name= "level'.$count_str.'" style = "text-align: center;padding-left: 3em;padding-right: 3em"><b>level 1</b><br><br>
						<!--<p><a class="btn btn-default" href="#" name= "improve'.$count_str.'" onclick="openPage('.$count_str.'); return false;">Improve &raquo;</a></p>-->					
						<p><input type="submit" value="IMPROVE &raquo" class="btn btn-default" name= "improve'.$count_str.'" onclick="openPage('.$count_str.'); return false;"></p>						
					
					</td>
				</tr>';
	}		

// Echo last HTML closing lines
echo '
					</tbody>
				</table>
			</div>
	</body>
	
	<footer>
			<p>&copy; medBiomarkers 2013</p>
	</footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src=".js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>	
</html>';

// Export function. Writes the csv in current folder (server side)
function array2csv(array &$array)
{
   if (count($array) == 0) {
     return null;
   }
   ob_start();
   $df = fopen("QCexport.csv", 'w');
   fputcsv($df, array_keys(reset($array)));
   foreach ($array as $row) {
      fputcsv($df, $row);
   }
   fclose($df);
   return ob_get_clean();   
}

//Update or create the file in server
array2csv($csv_array);


//Echo the Java script.
echo'
<script language="Javascript">


// Open PG3 for the corresponding abstratct (row number)
function openPage(nr)	
	{
		var ele = document.getElementsByName("entry" + nr)[0].innerHTML;
		window.location.href = "http://localhost/bsTests/pg3.php?abstract="+ ele;
			
	}
	
//This the export to CSV function
function exportCSV()	
	{
	alert("Exporting");
	//document.getElementById("main-wrap").innerHTML = "Hello";
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
		//document.getElementById("main-wrap").innerHTML = xmlhttp.responseText;
		alert("Done! Data exported to QCreport.csv");
	    }
	  }
	//alert("Hello2");
	// Calls the PHP function. Sends parameters via GET.
	xmlhttp.open("GET","CSVexport.php",true);
	xmlhttp.send();
	}			


</script>';
							  
	// disconnect from server
	$conn->close();
	} catch (MongoConnectionException $e) {
	die('Error connecting to MongoDB server');
	} catch (MongoException $e) {
	die('Error: ' . $e->getMessage());
	}
?>