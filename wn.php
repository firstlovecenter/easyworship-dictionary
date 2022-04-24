<?php
include("connection.php");
$cID = $_GET["wid"];

if(empty($cID)){die('<center style="font-weight: bold; color:#F00">You cannot access this page like this</center>');}

if(!is_numeric($cID)){
	$sql2 = "SELECT * FROM `wn_synset` WHERE `word`='".$_GET["wid"]."'"; 

	$sql_result2 = mysqli_query($conn, $sql2) or die ('request "Could not execute SQL query" '.$sql2);

	$row["word"] = $_GET["wid"];
}
else{
$sql2 = "SELECT `synset_id` FROM `wn_gloss` WHERE `synset_id`='".$_GET["wid"]."'"; 

$sql_result2 = mysqli_query($conn, $sql2) or die ('request "Could not execute SQL query" '.$sql2);

$sql = "SELECT `word` FROM `wn_synset` WHERE `id`='".$_GET["wid"]."'";

$sql_result = mysqli_query($conn, $sql) or die ('request "Could not execute SQL query" '.$sql);
$row = mysqli_fetch_assoc($sql_result);
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo ucwords(strtolower($row["word"]));?> (WordNet Dictionary)</title>  
		

		<?php
			include("def-header.php");
			$num_rows = 0;
			while($row2 = mysqli_fetch_assoc($sql_result2)){
				 $num_rows++;
				
				$sql3 = "SELECT `gloss` FROM `wn_gloss` WHERE `synset_id`='".$row2["id"]."'"; 
				$sql_result3 = mysqli_query($conn, $sql3) or die ('request "Could not execute SQL query" '.$sql3);
				$row3 = mysqli_fetch_assoc($sql_result3);
				
				echo '<li class="hide'.$num_rows.'" value="'.$num_rows.'"><input type="checkbox" name="chk" class="chk">'.str_replace( array('{{','}}') , array('<span style="color: #F0FF00;">','</span>')  , str_replace(array('[[',']]'),'',$row3['gloss'])).'</li>';
			}
			include("def-footer.php");
	   ?>
	