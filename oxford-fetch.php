<?php
//sleep(1);
//include connection file 
	include_once("oxford-connection.php");
 
$query = (!empty($_GET['q'])) ? strtolower($_GET['q']) : null;
 
if (!isset($query)) {
    die('Invalid query.');
}
 
$status = true;
$databaseUsers = array();
$sql = "SELECT * FROM `oedict` WHERE word='".$_GET["q"]."' OR word LIKE '%".$_GET["q"]."%' GROUP BY `word`";
$queryTot = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
while( $row = mysqli_fetch_array($queryTot) ) {
		$words[] = array(
								"id"	=>	$row["id"], 
								"word"	=>	ltrim($row["word"]));
}

$databaseUsers = $words;
/* header('Content-Type: application/json');
 
echo json_encode(array(
    "status" => $status,
    "error"  => null,
    "data"   => array(
        "user"      => $databaseUsers
    )
	)); */
/* $databaseUsers = array(
    array(
        "id"        => 4152589,
        "username"  => "TheTechnoMan"
    ),
    array(
        "id"        => 7377382,
        "username"  => "running-coder"
    ),
    array(
        "id"        => 748137,
        "username"  => "juliocastrop"
    ),
    array(
        "id"        => 619726,
        "username"  => "cfreear"
    ),
    array(
        "id"        => 5741776,
        "username"  => "solevy"
    ),
    array(
        "id"        => 906237,
        "username"  => "nilovna"
    ),
    array(
        "id"        => 612578,
        "username"  => "Thiago Talma"
    ),
    array(
        "id"        => 2051941,
        "username"  => "webcredo"
    ),
    array(
        "id"        => 985837,
        "username"  => "ldrrp"
    ),
    array(
        "id"        => 1723363,
        "username"  => "dennisgaudenzi"
    ),
    array(
        "id"        => 2649000,
        "username"  => "i7nvd"
    ),
    array(
        "id"        => 2757851,
        "username"  => "pradeshc"
    )
); */
 
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