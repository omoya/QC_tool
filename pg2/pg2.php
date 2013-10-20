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
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="form.css">
		<script src="form.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	</head>
	<body>
		<div id="main-wrap">';
			// Echo the number of documents retrieved
			//TODO: format the link as a button or similar.
			//Create a link to the file
echo $cursor->count() . ' document(s) found&nbsp&nbsp';
echo '<a href="QCexport.csv">Export to CSV</a>';

// Keep echoing the static HTML lines. Including table div openning and headers.
echo '
		</div>
		<div class="CSSTableGenerator">
			<span id="insert"></span>
			<table border="0">			
				<tbody>
					<td>PMID</td>
					<td>Title</td>
					<td>Abstract</td>
					<td>Keywords</td>
					<td>Entry status</td>
					<td>Actions</td>';			
	
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
					<td name= "title'.$count_str.'">';
echo
	$obj['submission']['publication']['title'].'</td>';
echo '						
					<td name= "abstract'.$count_str.'">';
echo
	$obj['submission']['publication']['abstract'].'</td>';
echo '
					<td name= "keywords'.$count_str.'">';
echo
	 $obj['submission']['publication']['keywords'].'</td>';
echo '
					<td name= "level'.$count_str.'">level 1</td>
					<td>
						<input type="submit" value="IMPROVE" name= "improve'.$count_str.'" onclick="openPage('.$count_str.'); return false;">						
					</td>
				</tr>';
	}		

// Echo last HTML closing lines
echo '
			</tbody>
				</table>
			</div>
	</body>		
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

//This is a test
function testing()	
	{
	alert("Hello");
	document.getElementById("main-wrap").innerHTML = "Hello";
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
		document.getElementById("main-wrap").innerHTML = xmlhttp.responseText;
	    }
	  }
	alert("Hello2");
	// Calls the PHP function. Sends parameters via GET.
	xmlhttp.open("GET","printA.php",true);
	xmlhttp.send();
	}
	
	// Another test
function openPage(nr)	
	{
		if (nr > 3){
			window.location.href = "http://localhost/pg2/printA.php"
		}
		else {
			window.location.href = "http://localhost/pg2/printB.php?pmid=12"
		}
	function httpGet()
	    {
	    	alert("Hello3");
	    	window.location.href = "http://localhost/pg2/printB.php?pmid=12"
	    }
			
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