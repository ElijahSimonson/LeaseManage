<?php
include('source/pagebase.php');
if (!checkAccess(0)){
  header('Location:  _errorpages/403.html');
}
?>
<head>

<?php include('source/devicesHead.php');?>

</head>
<body>
<?php
echo "Identifier : " . $_SESSION['identifier'];
?>
<div id="devices">
<form target="_blank" action="qrPrint.php" method="POST">
<table border="1" >
  <thead>
  	<tr>
    	<td>Serial Number</td>
    	<td>Leased/Owned</td>
    	<td>Device Name</td>
    	<td>Description</td>
    	<td>Device Holder</td>
    	<td>Date of Purchase/Return</td>
    	<td>Lease List</td>
   	</tr>
  </thead>
  <tbody class="list">
<?php
devicesTable();
?>	
	</tbody>

</table>

<div class="fixedBottom" align="right">
<input class="search" placeholder="Search">
&nbsp;&nbsp;&nbsp;
<input type="submit" value="Print QR" id='print'>
&nbsp;&nbsp;&nbsp;
<input type="button" value="Delete" id='delete'>
&nbsp;&nbsp;&nbsp;
<input type="checkbox" id='checkall'>Check All
</div>

<script type="text/javascript" src="source/list.js"></script>
<script type="text/javascript">
  var options = {
  valueNames: [ 'serial', 'place', 'name', 'description', 'owner', 'date', 'assocList' ]
};

var userList = new List('devices', options);
</script>
</form>
</div>


</body>
</html>