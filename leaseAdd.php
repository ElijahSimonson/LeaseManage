<?php
include("source/pagebase.php");
if (!checkAccess(1)){
    header('Location: _errorpages/403.html');
}
?>
<html>
<head>
	<script type="text/javascript" src="source/jquery.js"></script>
	<script type="text/javascript">
	function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		vars[key] = value;
	});
	return vars;
}


$(document).ready(function(){
		if (getUrlVars()['success'] == 1){
			alert("Leased Items Added Successfully");
		}
		if (getUrlVars()['success'] == 0){
			alert("Either an error occured or you did not supply a csv");
		}
});
</script>

<?php

?>

</head>
<body>

<form action="request/addList.php" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
  Choose CSV to upload: <br /> 
  <input name="csv" type="file" id="csv" /> 
  <input type="submit" name="Submit" value="Add Devices" /> 
</form> 

</body>
</html>
