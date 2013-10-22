<?php
//get the q parameter from URL
$pmid_input = $_GET["pmid"];
$keywords = $_GET["kw"];

### This function accepts long URLs, short URLs and PMIDs
### Process numeric inputs
if (is_numeric($pmid_input)) {
        		$pmid_url = "http://www.ncbi.nlm.nih.gov/pubmed/".$pmid_input;
				$pmid = $pmid_input;	
    			} 
### Process url inputs
else{ 
	### Process short url input when given, transforming it to long url
	if (get_headers($pmid_input, 7)){		
		###Retrieve long URL from headers of the HTTP response
		$longURL = get_headers($pmid_input, 7);
		try{
			if (isset($longURL['Location'])){
				$pmid_input = $longURL['Location'];
			}
		}
		catch (Exception $e) {
		}
	} 

	###Extract the PMID number from the long URL. It can be with or without the "?term=" substring
	$pmid= str_replace('http://www.ncbi.nlm.nih.gov/pubmed/','',$pmid_input);
	$pmid= str_replace('?term=','',$pmid);
}

// Create the url to the xml from the pmid number
$xml_url = "http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&id=".$pmid."&retmode=xml";

//Data retrieved from URL contents  
$info = @file_get_contents("$xml_url");

$xml=simplexml_load_string($info);

$path = '/PubmedArticleSet/PubmedArticle/MedlineCitation/';

// ArticleTitle 
$ArticleTitle = $xml->xpath($path . '/ArticleTitle'); 

// AbstractText 
$AbstractText= $xml->xpath($path . '/Abstract/AbstractText'); 

//Create an array with the data retrieved from the form and the data retrieved from ncbi

header('Content-Type: application/json');
$return = array();

$return['pmid'] = $pmid;
$return['keywords'] = $keywords;
$return['title'] = "$ArticleTitle[0]";
$return['abstract'] = "$AbstractText[0]";

echo json_encode($return);
?>