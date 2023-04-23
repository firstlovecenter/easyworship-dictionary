<!DOCTYPE html>  
 <html>  
      <head>  
           <title>Dictionary - Search word</title>  
           <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />  
           <script src="bootstrap/js/bootstrap.min.js"></script>  
           <script src="plugins/jQuery/3.2.1/jQuery-3.2.1.js"></script> 
           <style>  
           ul{  
                background-color:#eee;  
                cursor:pointer;  
           }  
           li{  
                padding:12px;  
           }  
		   
div#dwrapper {
  text-align: center;
}
h1 {
  font-size: 50vmin;
  position: absolute;
  top: 50%;
  margin-top: -25vmin;
  width: 100%;
}
           </style> 
<script> 
$(document).ready(function() {
  var startHeight = $('.content').outerHeight() - $('.content').height();
  var newHeight = $(window).height() - $('.header').outerHeight() - $('.menu').outerHeight() - $('.footer').outerHeight() - startHeight;
  
  $('.content').css('height',newHeight);
});
</script> 		   
      </head>  
      <body>  
           <div class="container" style="width:500px;"><br>
                <input type="text" name="country" id="country" class="form-control" placeholder="Enter Word" />  
                <div id="countryList"></div> 
					 
           </div>  
		   <div id="dwrapper"><h1 id="def"></h1></div>
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#country').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:"search.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#countryList').fadeIn();  
                          $('#countryList').html(data);  
                     }  
                });  
           }
			else{
				$('#countryList').html('');
			}
      });  
      $(document).on('click', 'li', function(){  
			var proceed = true;
			$('#country').val($(this).text());  
			$('#countryList').fadeOut();
		   
			var word_id = $(this).attr('data-wid');
			var word_num = $(this).attr('data-wnum');
			window.location = 'definition.php?wid='+word_id+'&wnum='+word_num;
			
      }); 

				$("body").keypress(function(e){
					if(e.shiftKey && (e.which == 100 || e.which == 68)){
						window.location = '/dictionary';
					}
				})  
 });  
 </script>  