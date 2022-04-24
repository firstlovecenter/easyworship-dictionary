<?php
if(isset($_GET["wid"])){
	$word = "value=".$_GET["wid"];
}
if(isset($_GET["did"])){
	$dict_id = $_GET["did"];
}
else{
	$dict_id = "webs";
}
?><!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title></title>
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="src/jquery.typeahead.css">

    <script src="plugins/jQuery/3.2.1/jQuery-3.2.1.js"></script>
    <!--script src="../dist/jquery.typeahead.min.js"></script-->
    <script src="src/jquery.typeahead.js"></script>
	<style>
	#form-user_v1 .typeahead__list {
    max-height: 300px;
    overflow-y: auto;
    overflow-x: hidden;
}
 
.project-jquerytypeahead.page-demo .typeahead__list li a {
    position: relative;
}
 
.project-jquerytypeahead.page-demo .result-container {
    position: absolute;
    color: #777;
    top: -1.5em;
}
 
.project-jquerytypeahead.page-demo .typeahead-search li a .flag-chart {
    position: absolute;
    right: 16px;
    top: 10px;
}
 
.flag-chart {
    position: absolute;
    right: 10px;
    top: 6px;
    width: 30px;
    height: 20px;
    line-height: 14px;
    vertical-align: text-top;
    display: inline-block;
    margin: -1px 3px -1px 0;
    background:url(/assets/jquerytypeahead/img/country_v2.png) no-repeat scroll left top transparent;
}
select{margin-bottom: 20px;
width: 100%;
height: 38px;}
	</style>
</head>
<body>

<div style="width: 100%; max-width: 800px; margin: 0 auto; padding-top:50px">
<?php 
//$did = 
$$dict_id = 'selected="selected"';

include ("dictionaries.php");
?>
<div class="js-result-container"></div>
    <form id="form-user_v1" name="form-user_v1" action="<?php echo $dict_id.'.php'; ?>" method="get">
    <div class="typeahead__container">
        <div class="typeahead__field">
 
            <span class="typeahead__query">
			<input type="hidden" name="did" value="<?php echo $dict_id; ?>">
                <input class="js-typeahead-user_v1" id="sword" <?php if(isset($_GET["wid"]) && !empty($_GET["wid"])){echo "value=".$_GET["wid"];} ?> name="wid" placeholder="Search" autocomplete="off" type="search">
				
            </span>
            <span class="typeahead__button">
                <button type="submit">
                    <i class="typeahead__search-icon"></i>
                </button>
            </span>
 
        </div>
    </div>
</form>

    <script>
	
	$('.js-typeahead-user_v1').focus();
	
	
        $.typeahead({
    input: '.js-typeahead-user_v1',
    minLength: 1,
    dynamic: true,
	maxItem: 100,
	searchOnFocus: true,
	offset: true,
    backdrop: {
        "background-color": "#fff"
    },
    template: function (query, item) {
 
        var color = "#777";
        if (item.status === "owner") {
            color = "#ff1493";
        }
 
        return '<span class="row">' +
            '<span class="word">{{word}} </span>' +
        "</span>"
    },
    emptyTemplate: "no result for {{query}}",
    source: {
        user: {
            display: "word",
            href: "<?php echo $dict_id; ?>.php?did=<?php echo $dict_id; ?>&wid={{id|slugify}}",
            ajax: function (query) {
                return {
                    type: "GET",
                    url: "fetch.php?did=<?php echo $dict_id; ?>",
                    path: "data.user",
                    data: {
                        q: "{{query}}"
                    },
                    callback: {
                        done: function (data) {
                            for (var i = 0; i < data.data.user.length; i++) {
                                if (data.data.user[i].word === 'running-coder') {
                                    data.data.user[i].status = 'owner';
                                } else {
                                    data.data.user[i].status = 'contributor';
                                }
                            }
                            return data;
                        }
                    }
                }
            }
 
        }
    },
    callback: {
        onClick: function (node, a, item, event) {
 
            // You can do a simple window.location of the item.href
            window.location = JSON.stringify(item);
 
        },
        onSendRequest: function (node, query) {
            console.log('request is sent')
        },
        onReceiveRequest: function (node, query) {
            console.log('request is received')
        },
		onNavigateAfter: function (node, lis, a, item, query, event) {
            if (~[38,40].indexOf(event.keyCode)) {
                var resultList = node.closest("form").find("ul.typeahead__list"),
                    activeLi = lis.filter("li.active"),
                    offsetTop = activeLi[0] && activeLi[0].offsetTop - (resultList.height() / 2) || 0;
 
                resultList.scrollTop(offsetTop);
            }
 
        },
		onResult: function (node, query, result, resultCount) {

                
					if (query === "") return;
 
            var text = "";
            if (result.length > 0 && result.length < resultCount) {
                text = "Showing <strong>" + result.length + "</strong> of <strong>" + resultCount + '</strong> elements matching "' + query + '"';
            } else if (result.length > 0) {
                text = 'Showing <strong>' + result.length + '</strong> elements matching "' + query + '"';
            } else {
                text = 'No results matching "' + query + '"';
            }
            $('.js-result-container').html(text);
                }
    },
	    debug: false
});
    </script>

</div>
<script type="text/javascript">
			$(document).ready(function(){
				$('select').on('change', function() {
					var word = $('#sword').val();
					window.location = '?did='+this.value+'&wid='+word;
				})
			});
		</script>
</body>
</html>