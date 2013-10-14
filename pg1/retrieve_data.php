<?php
//get the parameters from GET URL

$pmid_input = $_GET["pmid"];
$keywords = $_GET["kw"];
$pmid_input2 = $_GET["pmid2"];
$keywords2 = $_GET["kw2"];
$pmid_input3 = $_GET["pmid3"];
$keywords3 = $_GET["kw3"];

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

### This function accepts long URLs, short URLs and PMIDs
### Process numeric inputs
if (is_numeric($pmid_input2)) {
        		$pmid_url2 = "http://www.ncbi.nlm.nih.gov/pubmed/".$pmid_input2;
				$pmid2 = $pmid_input2;	
    			} 
### Process url inputs
else{ 
	### Process short url input when given, transforming it to long url
	if (get_headers($pmid_input2, 7)){		
		###Retrieve long URL from headers of the HTTP response
		$longURL2 = get_headers($pmid_input2, 7);
		try{
			if (isset($longURL2['Location'])){
				$pmid_input2 = $longURL2['Location'];
			}
		}
		catch (Exception $e) {
		}
	} 

	###Extract the PMID number from the long URL. It can be with or without the "?term=" substring
	$pmid2= str_replace('http://www.ncbi.nlm.nih.gov/pubmed/','',$pmid_input2);
	$pmid2= str_replace('?term=','',$pmid2);
}

### This function accepts long URLs, short URLs and PMIDs
### Process numeric inputs
if (is_numeric($pmid_input3)) {
        		$pmid_url3 = "http://www.ncbi.nlm.nih.gov/pubmed/".$pmid_input3;
				$pmid3 = $pmid_input3;	
    			} 
### Process url inputs
else{ 
	### Process short url input when given, transforming it to long url
	if (get_headers($pmid_input3, 7)){		
		###Retrieve long URL from headers of the HTTP response
		$longURL3 = get_headers($pmid_input3, 7);
		try{
			if (isset($longURL3['Location'])){
				$pmid_input3 = $longURL3['Location'];
			}
		}
		catch (Exception $e) {
		}
	} 

	###Extract the PMID number from the long URL. It can be with or without the "?term=" substring
	$pmid3= str_replace('http://www.ncbi.nlm.nih.gov/pubmed/','',$pmid_input3);
	$pmid3= str_replace('?term=','',$pmid3);
}



// Create the urls form the pmid numbers 
$xml_url = "http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&id=".$pmid."&retmode=xml";
$xml_url2 = "http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&id=".$pmid2."&retmode=xml";
$xml_url3 = "http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&id=".$pmid3."&retmode=xml";

//Data retrieved from URL contents  
$info = @file_get_contents("$xml_url");
$info2 = @file_get_contents("$xml_url2");
$info3 = @file_get_contents("$xml_url3");

$xml = simplexml_load_string($info);
$xml2 = simplexml_load_string($info2);
$xml3 = simplexml_load_string($info3);

$path = '/PubmedArticleSet/PubmedArticle/MedlineCitation/';

// ArticleTitle 
$ArticleTitle = $xml->xpath($path . '/ArticleTitle');
$ArticleTitle2 = $xml2->xpath($path . '/ArticleTitle'); 
$ArticleTitle3 = $xml3->xpath($path . '/ArticleTitle'); 


// AbstractText 
$AbstractText= $xml->xpath($path . '/Abstract/AbstractText');
$AbstractText2= $xml2->xpath($path . '/Abstract/AbstractText'); 
$AbstractText3= $xml3->xpath($path . '/Abstract/AbstractText'); 

header('Content-Type: application/json');
$return = array();

$return['pmid'] = $pmid;
$return['keywords'] = $keywords;
$return['title'] = "$ArticleTitle[0]";
$return['abstract'] = "$AbstractText[0]";

$return['pmid2'] = $pmid2;
$return['keywords2'] = $keywords2;
$return['title2'] = "$ArticleTitle2[0]";
$return['abstract2'] = "$AbstractText2[0]";

$return['pmid3'] = $pmid3;
$return['keywords3'] = $keywords3;
$return['title3'] = "$ArticleTitle3[0]";
$return['abstract3'] = "$AbstractText3[0]";

echo json_encode($return);
?>