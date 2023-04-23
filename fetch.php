<?php
//sleep(1);
//include connection file 
	include_once("connection.php");
 
$query = (!empty($_GET['q'])) ? strtolower($_GET['q']) : null;
 
if (!isset($query)) {
    die('Invalid query.');
}
 
$status = true;
$databaseUsers = array();

if($_GET['did'] == 'webs'){
	$sql = "SELECT * FROM `webs_entries` WHERE word='".$_GET["q"]."' OR word LIKE '%".$_GET["q"]."%' GROUP BY `word`";
}
elseif($_GET['did'] == 'wiki'){
	$sql = "SELECT * FROM `wiki_dict` WHERE word='".$_GET["q"]."' OR word LIKE '%".$_GET["q"]."%' GROUP BY `word`";
}
elseif($_GET['did'] == 'ddc'){
	$sql = "SELECT * FROM `ddc_entries` WHERE word='".$_GET["q"]."' OR word LIKE '%".$_GET["q"]."%' GROUP BY `word`";
}
elseif($_GET['did'] == 'wn'){
	$sql = "SELECT * FROM `wn_synset` WHERE `word`='".$_GET["q"]."' OR `word` LIKE '%".$_GET["q"]."%' GROUP BY `word`";
}elseif($_GET['did'] == 'oe'){
	$sql = "SELECT * FROM `oedict` WHERE word='".$_GET["q"]."' OR word LIKE '%".$_GET["q"]."%' GROUP BY `word`";
}
$queryTot = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
while( $row = mysqli_fetch_array($queryTot) ) {
		$words[] = array(
								"id"	=>	$row["id"], 
								"word"	=>	ltrim($row["word"]));
}

$databaseUsers = $words;
 
$resultUsers = [];
foreach ($databaseUsers as $key => $oneUser) {
    if (strpos(strtolower($oneUser["word"]), $query) !== false ||
        strpos(str_replace('-', '', strtolower($oneUser["word"])), $query) !== false ||
        strpos(strtolower($oneUser["id"]), $query) !== false) {
        $resultUsers[] = $oneUser;
    }
}
 
// Means no result were found
if (empty($resultUsers)) {
    $status = false;
}
 
header('Content-Type: application/json');
 
echo json_encode(array(
    "status" => $status,
    "error"  => null,
    "data"   => array(
        "user"      => $resultUsers
    )
));
?>