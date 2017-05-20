<?php
session_start();
if (!isset($_SESSION['user']) && basename($_SERVER['PHP_SELF']) != 'login.php'){
	$login = '../login.php?page=' . 'admin/' . basename($_SERVER['PHP_SELF']);
	header("Location: $login");
	die;
}
?>

<html>
<head>	
<?php
include('source/api.php');
?>
	<script type="text/javascript" src="//code.jquery.com/jquery-git.js"></script>
	<script src='source/sorttable.js'></script>
	<link href='source/styles.css' rel='stylesheet' type='text/css' media="screen">
	<link href="source/print.css" rel="stylesheet" type="text/css" media="print">
		<title>LeaseManage - Admin Console</title>
</head>
<body>
<header class='noPrint'>

		<img src="source/icons/logo.png" width="943" height="116"><br/>

</header>
<header>
<div class="menu">
	<input type="button" class="new" value="Add Devices" onClick="location.href='../newEntry.php'"> <br/>
	<input type="button" class="device" value="Device Log" onClick="location.href='../devices.php'"> <br/>
	<input type="button" class="leaseAdd" value="Manage Leases" onClick="location.href='../leaseAdd.php'"> <br/>
	
	<?php
	if (isset($_SESSION['access'])){
		if($_SESSION['access'] > 0){
			echo "<input type='button' class='admin' onclick=\"location.href='#'\" value='Admin Controls'><br/>"; 
		}
	}
	if (isset($_SESSION['user'])){
		echo "<input type='button' class='logout' value='" . $_SESSION['user'] . " (Logout)' onclick=\"location.href='../logout.php'\"><br/>";
	}else{
		if (basename($_SERVER['PHP_SELF']) != 'login.php') {
			echo "<input type='button' class='login' value='Not Signed In' onclick=\"location.href='../login.php'\"><br/>";
		}
	}		

	?>
</div>
</header>

<body>
<iframe width="100%" height="100%" src="userdetail.php"></iframe>
</body>
</html>
