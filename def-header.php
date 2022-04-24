<?php
	$did = $_GET["did"];
	if(empty($did) && !isset($did)){die('<center style="font-weight: bold; color:#F00">You cannot access this page like this</center>');}
?>
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
	overflow: hidden;
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
	width: 1750px;
	display: inline-block;
	height: 990px;
	font-family: tahoma;
	margin-top: 55px;
	margin-bottom: 55px;
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
		overflow: visible;
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
	<div class='jtextfill'>
		<h1>
			<u id="word" style="color:#FF9900; text-align: center;">
				<a style="color:#FF9900; text-align: center;" href="index.php?did=<?php echo $did; ?>&wid=<?php echo $word; ?>"><?php echo ucwords(strtolower($word));?>:</a>
			</u><br>
			<ul class="defi" style="list-style-position: inside; text-align: left;margin-top: 20px;">