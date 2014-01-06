<?php	

//Testing git collaboration

	$pmid = $_GET["id"];
	$keywords = $_GET["kw"];
	$title = $_GET["title"];
	$abstract = $_GET["abstract"];
	$pmid2 = $_GET["id2"];
	$keywords2 = $_GET["kw2"];
	$title2 = $_GET["title2"];
	$abstract2 = $_GET["abstract2"];
	$pmid3 = $_GET["id3"];
	$keywords3 = $_GET["kw3"];
	$title3 = $_GET["title3"];
	$abstract3 = $_GET["abstract3"];
	
	//echo $keywords3;
	
	
	try {
  // open connection to MongoDB server
  //$conn = new Mongo('localhost:27017');
  $conn = new Mongo('mongodb://medb:medb2013medb@ds049548.mongolab.com:49548/medb');
  

  // access database
  //$db = $conn->test;
  $db = $conn->medb;

  // access collection
  $collection = $db->dev3;

  // insert a new document 
  
  $item = array(
				"submission" => array(
										"submission_date" => date("Y-m-d H:i:s"),
										"username" => "omoya",
										"publication"=> array( 
															"PMID"=>$pmid,
															"title"=> $title,
															"abstract"=>$abstract,
															"keywords"=>$keywords
															)));
  
  
  $collection->insert($item);
  
    // insert a new document 
  
  $item = array(
				"submission" => array(
										"submission_date" => date("Y-m-d H:i:s"),
										"username" => "omoya",
										"publication"=> array( 
															"PMID"=>$pmid2,
															"title"=> $title2,
															"abstract"=>$abstract2,
															"keywords"=>$keywords2
															)));
  
  
  $collection->insert($item);
  
    // insert a new document 
  
  $item = array(
				"submission" => array(
										"submission_date" => date("Y-m-d H:i:s"),
										"username" => "omoya",
										"publication"=> array( 
															"PMID"=>$pmid3,
															"title"=> $title3,
															"abstract"=>$abstract3,
															"keywords"=>$keywords3
															)));
  
  
  $collection->insert($item);
  
  
   
  // execute query
  // retrieve all documents
  $cursor = $collection->find();

  // iterate through the result set
  // print each document
  //echo $cursor->count() . ' document(s) found. <br/>';
  
  echo '		<table border="0">
			
			<tbody>
					<td>PMID</td>
					<td>Title</td>
					<td>Abstract</td>
					<td>Keywords</td>
					<td>Actions</td>'
					
			;
			
  foreach ($cursor as $obj) {
    echo '<tr><td>';
	echo  $obj['submission']['publication']['PMID'] . '<br/>';
	echo '</td><td>';
    echo  $obj['submission']['publication']['title'] . '<br/>';
	echo '</td><td>';
    echo  $obj['submission']['publication']['abstract'] . '<br/>';
	echo '</td><td>';
    echo  $obj['submission']['publication']['keywords']. '<br/>';
	echo '</td><td>';
	echo '<button type="button">IMPROVE</button>';
	echo '</td>.</tr>';
  }
  echo '</tbody></table>';
  
  // disconnect from server
  $conn->close();
} catch (MongoConnectionException $e) {
  die('Error connecting to MongoDB server');
} catch (MongoException $e) {
  die('Error: ' . $e->getMessage());
}

?>