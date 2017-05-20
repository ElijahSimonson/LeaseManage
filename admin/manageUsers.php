<?php
include('pagebaseAdmin.php');
include('source/usersHead.php');
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>

<div id='users'>
<table border="1">
	<thead>
		<tr>
			<td>User</td>
			<td>Full Name</td>
			<td>Account Type</td>
		</tr>
	</thead>
	<tbody class='list'>
		<?php  usersTable(); ?>
	</tbody>
</table>

<div class="fixedBottom" align="right">
<input class="search" placeholder="Search">
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

var userList = new List('users', options);
</script>

</div>
</body>
</html>