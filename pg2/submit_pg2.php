<?php	
try {
  // open connection to MongoDB server
  //$conn = new Mongo('localhost:27017');
  $conn = new Mongo('mongodb://medb:medb2013medb@ds049548.mongolab.com:49548/medb');
  

  // access database
  //$db = $conn->test;
  $db = $conn->medb;

  // access collection
  $collection = $db->dev3;

    
  // execute query
  // retrieve all documents
  $cursor = $collection->find();

  // iterate through the result set
  // print each document
  //echo $cursor->count() . ' document(s) found. <br/>';
echo '  
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="form.css">
		<script src="form.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	</head>

	<body>

		<div id="main-wrap">
		</div>

		<div class="CSSTableGenerator">
			<span id="insert"></span>

';


  
  echo '			<table border="0">
			
						<tbody>
								<td>PMID</td>
								<td>Title</td>
								<td>Abstract</td>
								<td>Keywords</td>
								<td>Entry status</td>
								<td>Actions</td>'
					
			;
			
  foreach ($cursor as $obj) {
    echo '			<tr><td>';
	echo  $obj['submission']['publication']['PMID'] . '<br/>';
	echo '			</td><td>';
    echo  $obj['submission']['publication']['title'] . '<br/>';
	echo '			</td><td>';
    echo  $obj['submission']['publication']['abstract'] . '<br/>';
	echo '			</td><td>';
    echo  $obj['submission']['publication']['keywords']. '<br/>';
	echo '		</td><td>';
	echo '		level 1';
	echo '		</td><td>';
	echo '		<button type="button">IMPROVE</button>';
	echo '		</td>.</tr>';
  }
  echo '		</tbody></table>';
  
  echo '  
		</div>	
	</body>		
</html>';	
  
  // disconnect from server
  $conn->close();
} catch (MongoConnectionException $e) {
  die('Error connecting to MongoDB server');
} catch (MongoException $e) {
  die('Error: ' . $e->getMessage());
}

?>