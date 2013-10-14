<?php
//get the q parameter from URL
$pmid = $_GET["pmid"];
$keywords = $_GET["kw"];

// Create the url form a pmid number (not yet urls)
// TODO: process long and short urls provided as input
$xml_url = "http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&id=".$pmid."&retmode=xml";


//Data retrieved from URL contents  
$info = @file_get_contents("$xml_url");

$xml=simplexml_load_string($info);

$path = '/PubmedArticleSet/PubmedArticle/MedlineCitation/';

// ArticleTitle 
$ArticleTitle = $xml->xpath($path . '/ArticleTitle'); 


// AbstractText 
$AbstractText= $xml->xpath($path . '/Abstract/AbstractText'); 


//Info retrieved from form

//echo "Data retrieved for PMID ".$pmid ."<br>";
//echo "With keywords: ".$keywords."<hr>";

//Info retrieved from ncbi

//echo "Title<br>".$ArticleTitle[0]."<br>";
//echo "Abstract<br>".$AbstractText[0]."<br>";

header('Content-Type: application/json');
//$return  = "{"username":"Bob"}";
//$return = "{"title":$ArticleTitle[0]}";
//echo json_encode($return);
$return = array();

$return['pmid'] = $pmid;
$return['keywords'] = $keywords;
$return['title'] = "$ArticleTitle[0]";
$return['abstract'] = "$AbstractText[0]";
//$return  = "{"username":"Bob"}";
echo json_encode($return);


?>