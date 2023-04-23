</ul>
		</h1>
	</div>
</div>
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