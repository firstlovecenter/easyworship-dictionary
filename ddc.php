<?php
include("connection.php");
$cID = $_GET["wid"];

if(empty($cID)){die('<center style="font-weight: bold; color:#F00">You cannot access this page like this</center>');}

if(!is_numeric($cID)){
	$q_text = "SELECT id FROM `ddc_entries` WHERE `word`='".$_GET["wid"]."' AND word LIKE '%".$_GET["wid"]."%'";
	
	$q_text_result = mysqli_query($conn, $q_text) or die ('request "Could not execute SQL query" '.$q_text);
	
	while($row_text = mysqli_fetch_assoc($q_text_result)){
	
		$sql2 = "SELECT * FROM `ddc_content_blocks` WHERE entry_id=".$row_text["id"]; 

		$sql_result2 = mysqli_query($conn, $sql2) or die ('request "Could not execute SQL query" '.$sql2);
	}
	/* $sql = "SELECT `word` FROM `entries` WHERE id='".$_GET["wid"]."'"; 

	$sql_result = mysqli_query($conn, $sql) or die ('request "Could not execute SQL query" '.$sql); */
	$word = $_GET["wid"];
}
else{

	$sql2 = "SELECT * FROM `ddc_content_blocks` WHERE `entry_id`=(SELECT `id` FROM `ddc_entries` WHERE `id`='".$_GET["wid"]."')"; 

	$sql_result2 = mysqli_query($conn, $sql2) or die ('request "Could not execute SQL query" '.$sql2);

	$sql = "SELECT * FROM `ddc_entries` WHERE `id`='".$_GET["wid"]."'";

	$sql_result = mysqli_query($conn, $sql) or die ('request "Could not execute SQL query" '.$sql);
	$row = mysqli_fetch_assoc($sql_result);
	$word = $row["word"];
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo ucwords(strtolower($word));?> (Dictionary.com)</title>  

		<?php
		include("def-header.php");
			while($row2 = mysqli_fetch_assoc($sql_result2)){
				echo str_replace( array('{{','}}') , array('<span style="color: #F0FF00;">','</span>')  , str_replace(array('[[',']]'),'',$row2['content']));
			}
			include("def-footer.php");
	   ?>
	