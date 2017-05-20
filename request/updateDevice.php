<?php
	include('../source/api.php');
	$query = "UPDATE `$_POST[ownedleased]` SET ";
	
foreach ($_POST as $key => $value) {
	if ($key != 'ownedleased'){
		if ($key == 'id'){
			continue;
		}
		if ($key == 'date'){
			$value = fixDate($value);
		}
		$query .= '`' . $key . "`='" . $value . "',";
	}	
}
$query .= "WHERE id = '" . $_POST;
$query = rtrim($query, ',');
try{
	$update = $db->prepare($query);
	$update->execute();
}catch(Exeption $e){
	echo $e;
	die;
}
echo json_encode('success');
exit()
?>