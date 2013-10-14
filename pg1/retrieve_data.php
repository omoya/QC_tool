<?php
//get the parameters from GET URL

$pmid = $_GET["pmid"];
$keywords = $_GET["kw"];
$pmid2 = $_GET["pmid2"];
$keywords2 = $_GET["kw2"];
$pmid3 = $_GET["pmid3"];
$keywords3 = $_GET["kw3"];
//echo $pmid;
//echo $keywords;
//echo $pmid2;
//echo $keywords2;
//echo $pmid3;
//echo $keywords3;

// Create the urls form the pmids number (not yet urls)
// TODO: process long and short urls provided as input
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