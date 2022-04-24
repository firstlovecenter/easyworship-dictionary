<?php
include("connection.php");
$cID = $_GET["wid"];

if(empty($cID)){die('<center style="font-weight: bold; color:#F00">You cannot access this page like this</center>');}

if(!is_numeric($cID)){
	$sql2 = "SELECT * FROM `oedict` WHERE `word`=\"".$_GET["wid"]."\" OR word LIKE \"%".$_GET["wid"]."%\""; 

	$sql_result2 = mysqli_query($conn, $sql2) or die ('request "Could not execute SQL query" '.$sql2);

	/* $sql = "SELECT `word` FROM `entries` WHERE id='".$_GET["wid"]."'"; 

	$sql_result = mysqli_query($conn, $sql) or die ('request "Could not execute SQL query" '.$sql); */
	$word = $_GET["wid"];

}
else{

	$sql2 = "SELECT * FROM `oedict` WHERE `word`=(SELECT `word` FROM `oedict` WHERE id='".$_GET["wid"]."')"; 

	$sql_result2 = mysqli_query($conn, $sql2) or die ('request "Could not execute SQL query" '.$sql2);

	$sql = "SELECT `word` FROM `oedict` WHERE id='".$_GET["wid"]."'"; 

	$sql_result = mysqli_query($conn, $sql) or die ('request "Could not execute SQL query" '.$sql);
	$row = mysqli_fetch_assoc($sql_result);
	$word = $row["word"];
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo ucwords(strtolower($word));?> (Oxford Dictionary)</title>  
		
<script src="plugins/jQuery/3.2.1/jQuery-3.2.1.js"></script>
	<!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
	
	<!--<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />  
	<!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/iCheck/square/_all.css">
<style>
body {
  margin: 0;
  background: #000; 
  color: #ffffff;
				font-family: Tahoma;
}
<?php
unset($_GET['wid']);
	foreach($_GET as $li){
		echo '.hide'.$li.'{
			display: none;
		}';
	}
?>
video { 
    position: fixed;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -100;
    transform: translateX(-50%) translateY(-50%);
 background: url('green.jpg') no-repeat;
  background-size: cover;
  transition: 1s opacity;
}
#polina { 
  text-align: center;
	padding: 55px 100px;
}
h1 {
  font-weight: bold;
  font-family: tahoma;
  margin-top: 0;
  margin-bottom: 0;
  text-shadow: 5px 5px 6px #000;
  filter: shadow(	Color=#000
					Direction=105,
					Strength=3);
}
.jtextfill{
	width: 100%;
	
	height: 970px;
	font-family: tahoma;
}
.icheckbox_square-green{
		display: none !important;
	}
@media all and (max-width: 1150px){
	.jtextfill{
		width: 750px;
		height: 300px;
	}
	video{
		display:none;
	}
	<?php
	foreach($_GET as $li){
		echo '.hide'.$li.'{
			display: list-item;
			text-decoration: line-through;
		}';
	}
	?>
	.icheckbox_square-green{
		display: inline-block !important;
		margin-right: 20px;
	}
	body{
		background-color: #fff;
		color: #000;
	}
	h1 {
		font-weight: lighter;
		font-family: trebulent;
		text-shadow: 0px 0px 0px #000;
		line-height: 1.5;
		font-size: 20px !important;
		filter: shadow(Color=#000
						Direction=105,
						Strength=0);
	}
}
@media screen and (max-device-width: 800px) {
  html { background: url(bg.jpg) #000 no-repeat center center fixed; }
  #bgvid { display: none; }
}
</style>
<script type="text/javascript">
;(function($) {
    $.fn.textfill = function(options) {
        var fontSize = options.maxFontPixels;
        var ourText = $('h1:visible:first', this);
        var maxHeight = $(this).height();
        var maxWidth = $(this).width();
        var textHeight;
        var textWidth;
        do {
            ourText.css('font-size', fontSize);
            textHeight = ourText.height();
            textWidth = ourText.width();
            fontSize = fontSize - 0.1;
        } while ((textHeight > maxHeight || textWidth > maxWidth) && fontSize > 3);
        return this;
    }
})(jQuery);

function resizeText()
{
  $('.jtextfill').textfill({ maxFontPixels: 250 });
}
$(document).ready(resizeText);
//$(window).resize(resizeText);
</script>
</head>
<body>
<video poster="bg.jpg" id="bgvid" playsinline autoplay muted loop>
  <!-- WCAG general accessibility recommendation is that media such as background video play through only once. Loop turned on for the purposes of illustration; if removed, the end of the video will fade in the same way created by pressing the "Pause" button  -->
<source src="Scripture_Bg.mp4" type="video/mp4">
</video>
<div id="polina" style="width:100%; height:100%;">
<div class='jtextfill'><h1>
	<u id="word" style="color:#FF9900; text-align: center;"><a style="color:#FF9900; text-align: center;" href="index.php?did=oe&wid=<?php echo $word; ?>"><?php echo ucwords(strtolower($word));?>:</a></u><br>
		<ul class="defi" style="list-style-position: inside; text-align: left">
		<?php
		
			$num_rows = 0;
			while($row2 = mysqli_fetch_assoc($sql_result2)){
				 $num_rows++;
				
				echo '<li class="hide'.$num_rows.'" value="'.$num_rows.'"><input type="checkbox" name="chk" class="chk">'.str_replace( array('{{','}}') , array('<span style="color: #F0FF00;">','</span>')  , str_replace(array('[[',']]'),'',$row2['meaning'])).'</li>';
			}
	   ?>
	</ul>
</h1></div>
<script>

$('input[type="checkbox"]').iCheck({
          checkboxClass: 'icheckbox_square-green',
          radioClass: 'iradio_minimal-red',
		  increaseArea: '20%'
        });	
<?php 
	foreach($_GET as $li){
		echo '$(\'.hide'.$li.' input[type="checkbox"]\').iCheck(\'check\');';
	}
?>
</script>
<script type="text/javascript">
			$(document).ready(function(){
				$("body").keypress(function(e){
					if(e.which == 99 || e.which == 67){
						if($("#polina").css("display") == "none"){
							$("#polina").css("display", "block");
						}
						else{
							$("#polina").css("display", "none");
						}
					}
					if(e.which == 119 || e.which == 87){
						window.location = '/dictionary';
					}
					if(e.which == 100 || e.which == 68){
						window.location = 'dict.php';
					}
				})
				
				/* function getSelectionParentElement() {
    var parentEl = null, sel;
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.rangeCount) {
            parentEl = sel.getRangeAt(0).commonAncestorContainer;
            if (parentEl.nodeType != 1) {
                parentEl = parentEl.parentNode;
            }
        }
    } else if ( (sel = document.selection) && sel.type != "Control") {
        parentEl = sel.createRange().parentElement();
    }
    return parentEl;
}
function getSelectionText() {
    var text = "";
    if (window.getSelection) {
        text = window.getSelection().toString();
    } else if (document.selection && document.selection.type != "Control") {
        text = document.selection.createRange().text;
    }
    return text;
}*/
});
	function GetURLParameter(sParam){
	    var sPageURL = window.location.search.substring(1);
	    var sURLVariables = sPageURL.split('&');
	    for (var i = 0; i < sURLVariables.length; i++){
	        var sParameterName = sURLVariables[i].split('=');
	        if (sParameterName[0] == sParam){
	            return sParameterName[1];
	        }
	    }
	}
	
	$(document).on('ifChecked', '.chk', function (){
		$(this).closest('li').css('text-decoration', 'line-through');
		var index = $(this).closest('li').attr('value');
		var url = window.location.href;
		history.pushState('data to be passed', 'Title of the page', url+'&hide'+index+'='+index);
	});
	$(document).on('ifUnchecked', '.chk', function (){
		$(this).closest('li').css('text-decoration', 'none');
		var unindex = $(this).closest('li').attr('value');
		var get = GetURLParameter('hide'+unindex);
		if(get == unindex){
			var curUrl = window.location.href;
			var newUrl = curUrl.replace('&hide'+unindex+'='+unindex,'');
			history.pushState('data to be passed', 'Title of the page', newUrl);
		}
    });
		</script>
</body>
</html>