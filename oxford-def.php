<?php
include("oxford-connection.php");
$cID = $_GET["wid"];

if(empty($cID)){die('<center style="font-weight: bold; color:#F00">You cannot access this page like this</center>');}

if(!is_numeric($cID)){
	$sql2 = "SELECT * FROM `oedict` WHERE `word`='".$_GET["wid"]."' OR word LIKE '%".$_GET["wid"]."%'"; 

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
<title><?php echo ucwords(strtolower($word));?></title>  
		
           <script src="plugins/jQuery/3.2.1/jQuery-3.2.1.js"></script>
			<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />  
<style>
body {
  margin: 0;
  background: #000; 
  color: #ffffff;
				font-family: Tahoma;
}
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
	padding: 55px 75px 45px 55px;
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
	border: 1px solid;
	height: 650px;
	font-family: tahoma;
}
@media all and (max-width: 1150px){
.jtextfill{
	width: 750px;
	height: 300px;
	border: 1px solid;
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
	<u id="word" style="color:#FF9900; text-align: center;"><?php echo ucwords(strtolower($word));?>:</u><br>
		<ul class="defi" style="list-style-position: inside; text-align: left">
		<?php
			while($row2 = mysqli_fetch_assoc($sql_result2)){
				echo '<li>'.$row2['meaning'].'</li>';
			}
	   ?>
	</ul>
</h1></div>
<script>
var vid = document.getElementById("bgvid");
var pauseButton = document.querySelector("#polina button");

if (window.matchMedia('(prefers-reduced-motion)').matches) {
    vid.removeAttribute("autoplay");
    vid.pause();
    pauseButton.innerHTML = "Paused";
}

function vidFade() {
  vid.classList.add("stopfade");
}

vid.addEventListener('ended', function()
{
// only functional if "loop" is removed 
vid.pause();
// to capture IE10
vidFade();
}); 

pauseButton.addEventListener("click", function() {
  vid.classList.toggle("stopfade");
  if (vid.paused) {
    vid.play();
    pauseButton.innerHTML = "Pause";
  } else {
    vid.pause();
    pauseButton.innerHTML = "Paused";
  }
})
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
			});
		</script>
</body>
</html>