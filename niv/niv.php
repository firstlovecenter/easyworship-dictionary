<?php

include("connection.php");

$xmlDoc = new DOMDocument();
$xmlDoc->load( 'niv.xml' );

$searchNode = $xmlDoc->getElementsByTagName( "b" ); 

foreach( $searchNode as $key=>$sarchNode )
{
    $valueID = $sarchNode->getAttribute('n');
	
	$chapter = $sarchNode->getElementsByTagName( "c" );
	$k = $key+1;
	echo $k;
	echo $valueID."<br>";
	
	foreach( $chapter as $chapter )
	{
		$cID = $chapter->getAttribute('n');
		echo $cID.'<br>';
		$sql2 = "INSERT INTO `chapter`(`book_id`, `chapter`) VALUES ('".$k."', '".$cID."')"; 

$sql_result2 = mysqli_query($conn, $sql2) or die ('request "Could not execute SQL query" '.$sql2);
	}

    /* $xmlDate = $searchNode->getElementsByTagName( "Date" );
    $valueDate = $xmlDate->item(0)->nodeValue;

    $xmlAuthorID = $searchNode->getElementsByTagName( "AuthorID" );
    $valueAuthorID = $xmlAuthorID->item(0)->nodeValue; */
   /* 
   $sql2 = "INSERT INTO `book`(`book_name`) VALUES ('".$valueID."')"; 

$sql_result2 = mysqli_query($conn, $sql2) or die ('request "Could not execute SQL query" '.$sql2); */
   
    
} 
?>