<?php 

//include connection file 
	include_once("connection.php");

$answer = [];

if (isset($_GET['q']) && (!empty($_GET['q']))) {

	$sql = "SELECT synset_id, word FROM `wn_synset` WHERE word LIKE '%".$_GET['q']."%'";
	
	$queryTot = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	
	$totalRecords = mysqli_num_rows($queryTot);
	
	if ($totalRecords > 0) {
		while( $row = mysqli_fetch_array($queryTot) ) { 
			$answer[] = array('id' => $row['synset_id'], 'text' => $row['word'] );
		}
	} 
else {$answer[] = array( 'id' => 0, 'text' => 'No search value sent from form.' );}

echo json_encode(array('items' => $answer));
}
?>