<?php
include("connection.php");
$cID = $_GET["wid"];

if(empty($cID)){die('<center style="font-weight: bold; color:#F00">You cannot access this page like this</center>');}

if(!is_numeric($cID)){
	$sql2 = "SELECT * FROM `webs_entries` WHERE `word`='".$_GET["wid"]."' OR word LIKE '%-".$_GET["wid"]."%'"; 

	$sql_result2 = mysqli_query($conn, $sql2) or die ('request "Could not execute SQL query" '.$sql2);

	/* $sql = "SELECT `word` FROM `entries` WHERE id='".$_GET["wid"]."'"; 

	$sql_result = mysqli_query($conn, $sql) or die ('request "Could not execute SQL query" '.$sql); */
	$word = $_GET["wid"];

}
else{

	$sql2 = "SELECT * FROM `webs_entries` WHERE `word`=(SELECT `word` FROM `webs_entries` WHERE id='".$_GET["wid"]."')"; 

	$sql_result2 = mysqli_query($conn, $sql2) or die ('request "Could not execute SQL query" '.$sql2);

	$sql = "SELECT `word` FROM `webs_entries` WHERE id='".$_GET["wid"]."'"; 

	$sql_result = mysqli_query($conn, $sql) or die ('request "Could not execute SQL query" '.$sql);
	$row = mysqli_fetch_assoc($sql_result);
	$word = $row["word"];
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo ucwords(strtolower($word));?> (Webster Unabridged Dictionary)</title>  
		
	
		<?php
			include("def-header.php");
			$num_rows = 0;
			while($row2 = mysqli_fetch_assoc($sql_result2)){
				 $num_rows++;
				
				echo '<li class="hide'.$num_rows.'" value="'.$num_rows.'"><input type="checkbox" name="chk" class="chk">'.str_replace( array('{{','}}') , array('<span style="color: #F0FF00;">','</span>')  , str_replace(array('[[',']]'),'',$row2['definition'])).'</li>';
			}
	   include("def-footer.php");
	   ?>