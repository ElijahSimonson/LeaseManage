<?php
include('source/pagebase.php');
if (isset($_COOKIE['user'])){
	header('Location: request/loginScript.php');
	die;
}
if (isset($_SESSION['user'])){
	header('Location: devices.php');
	die;
}
?>

<html>

<head>
<script type="text/javascript" src="source/jquery.js"></script>

</head>

<body>
<form method="POST" action="request/loginScript.php">
	<input type="text" name="login" placeholder="Username"><br>
	<input type="password" name="password" placeholder="Password"><br>
	<select>
		<?php
			$orgsArray = array('highSchool' => 'High School', 'intermediateSchool' => 'Intermediate School', 'primarySchool' => 'Primary School', 'business' => 'Business');
			foreach ($orgsArray as $org => $orgDesc){
				populateOrg($org, $orgDesc);
			}
		?>
	</select>
	Remember Login Details
	<input type="checkbox" name="remember" value="True" checked><br>
	<input type="submit" value="Login">
	<?php
		if(isset($_GET['page'])){
			echo "<input type=\"text\" value=\"" . $_GET['page'] ."\" hidden name=\"page\">" ;
		}
	?>
</form>
</body>

</html>