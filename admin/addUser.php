<?php
session_start();
include('pagebaseAdmin.php');
if (!checkAccess(2)){
    header('Location: ../_errorpages/403.html');
}
?>

<html>
<head>
	<title>LeaseManage - Add Users</title>

	<script type="text/javascript">
	$('form').submit(function(e){
		$.ajax({
            type: 'POST',
            url: "request/addUser.php",
            data: datastring,
            dataType: "JSON",
            success: function (res) {
                console.log(res);
                alert("User Added");
            },
            error: function (res) {
                console.log(res);
                alert("An Error Occur while adding the user. Please Try Again. If this error persists please contact your system administrator");
            },
        });
	});
	</script>
</head>
<body>
<form method="POST">
	<table>
		<tr>
			<td>Name of User</td>
			<td><input type="text" placeholder='' name="name" required></td>
		</tr>
		<tr>
			<td>User Code</td>
			<td><input type='text' placeholder=' (eg. cla)' name="user"  required></td>
		</tr>
		<tr>
			<td>Email Address</td>
			<td><input type="text" placeholder=' (If left blank user code will be used)' name='email'></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" placeholder='' name='password' required></td>
		</tr>
	</table>
	Access Level: &nbsp;&nbsp;&nbsp;
	ICT Admin<input type="radio" name="access" value="2">&nbsp;&nbsp;&nbsp;
	Device Manager<input type="radio" name="access" value="1">&nbsp;&nbsp;&nbsp;
	Device User<input type="radio" name="access" value="0">&nbsp;&nbsp;&nbsp;<br>
	<input type="submit" value="Create User">


</form>
</body>
</html>