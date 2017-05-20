<?php
include('../source/api.php');
$devices = $_POST;

foreach ($devices as $key=>$value){
	$index = "DELETE FROM `ownedleased` WHERE serialNumber = '$key'";
	$delete = "DELETE FROM `$value` WHERE serialNumber = '$key'";

	$db->exec($index);
	$db->exec($delete);
	if (file_exists("../QRS/" . $key . ".png")){
		unlink("../QRS/" . $key . ".png");
	} 
}

echo json_encode('success');
exit();
?>