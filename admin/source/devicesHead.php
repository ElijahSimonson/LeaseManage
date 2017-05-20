
<script src='source/list.js'></script>
<script src="source/jquery.js"></script>
<script type="text/javascript">
  
$(document).ready(function(e) {
    $('#delete').click(function(){
		var conf = confirm('Are you sure you want to delete the selected device(s)');
		if (conf == true) {
			$.ajax({
        type: 'POST',
				url:"request/removeDevice.php",
				data: $('form').serialize(),
				dataType: 'JSON',
				success: function(res){
					alert("Device(s) Successfully Removed");
          location.reload(true);
				},
				error: function(res){
          console.log(res);
					alert("An Error Occur while removing the device(s). Please Try Again. If this error persists please contact your system administrator")
				}
		});
		}
	});
});

</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#checkall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
              this.checked = true;//select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});

</script>



<!--  STYLES BELOW -->



<style type="text/css">
td {
  padding:10px; 
  border:solid 1px #eee;
}

a, a:visited {
  text-decoration: none;
  color: black;
}
a:hover {
  cursor: default;
  text-decoration: none;
}

.linkbutton {
  background:none!important;
  border:none; 
  padding:0!important;
  border-bottom:1px solid #444; 
  cursor: pointer;
}
</style>
