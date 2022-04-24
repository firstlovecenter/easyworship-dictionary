jQuery(document).ready(function() {
$.fn.editable.defaults.mode = 'popup';
 //enable / disable
   $('#enable').click(function() {
       $('#user .editable').editable('toggleDisabled');
   });    
    
    //editables 
    $('.xedit').editable({
		   disabled: true,
    });
	
	$('#username').editable({
        
		  
    });
    
    $('#firstname').editable({
        validate: function(value) {
           if($.trim(value) == '') return 'This field is required';
        }
    });
    
    $('#sex').editable({
        prepend: "not selected",
        source: [
            {value: 1, text: 'Male'},
            {value: 2, text: 'Female'}
        ],
        display: function(value, sourceData) {
             var colors = {"": "gray", 1: "green", 2: "blue"},
                 elem = $.grep(sourceData, function(o){return o.value == value;});
                 
             if(elem.length) {    
                 $(this).text(elem[0].text).css("color", colors[value]); 
             } else {
                 $(this).empty(); 
             }
        }   
    });    
    
    $('#status').editable();   
    
    $('#group').editable({
       showbuttons: false 
    });   

    $('#vacation').editable({
        datepicker: {
            todayBtn: 'linked'
        } 
    });  
        
    $('#dob').editable({disabled: true,});
          
    $('#event').editable({
        placement: 'right',
        combodate: {
            firstItem: 'name'
        }
    });      
    
    $('#meeting_start').editable({
        format: 'yyyy-mm-dd hh:ii',    
        viewformat: 'dd/mm/yyyy hh:ii',
        validate: function(v) {
           if(v && v.getDate() == 10) return 'Day cant be 10!';
        },
        datetimepicker: {
           todayBtn: 'linked',
           weekStart: 1
        }        
    });            
    
    $('#comments').editable({
        showbuttons: 'bottom'
    }); 
    
    $('#note').editable(); 
    $('#pencil').click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        $('#note').editable('toggle');
   });   
   
    $('.title').editable({
		disabled: true,
        source: [
              {value: 'Mr.', text: 'Mr.'},
              {value: 'Mrs.', text: 'Mrs.'},
              {value: 'Miss', text: 'Miss'}
           ]
    });
	                     
         
$(document).on('click','.editable-submit',function(){
var x = $(this).closest('span').children('span').attr('id');
var y = $('.input-sm').val();
var z = $(this).closest('span').children('span');
$.ajax({
url: "process.php?id="+x+"&data="+y,
type: 'GET',
success: function(s){
if(s == 'status'){
$(z).html(y);}
if(s == 'error') {
alert('Error Processing your Request!');}
},
error: function(e){
alert('Error Processing your Request!!');
}
});
});
});
