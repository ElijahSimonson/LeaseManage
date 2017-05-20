<?php
include('../source/api.php');

$ownedleased = $_POST['ownedleased'];
$serial = $_POST['SerialNumber'];
$description = $_POST['Description'];
$price = $_POST['PurchasePrice'];
$owner = $_POST['Owner'];
$name = $_POST['deviceName'];

if ($_POST['FullDescription'] == ""){
	$fullDesc = "No Description Provided";
}else{
	$fullDesc = $_POST['FullDescription'];
};

$date = $_POST['PurchasedReceived'];
if (!$date = fixDate($date)){
	$date = $_POST['PurchasedReceived'];
}


if (!isset($_POST['keepInfo'])){
	$_POST['keepInfo'] = 'off';
}

if ($_POST['DescriptionDropdown'] == 'nul'){
	$sql = "INSERT INTO `deviceTypes` (deviceType) VALUES ('$description')";
	$db->exec($sql);
}
if (!checkExists($serial)){
	if ($ownedleased == 'owned'){
		$index = "INSERT INTO `ownedleased` (`serialNumber`, `ownedleased`) VALUES ('$serial', 'owned')";
		$query = "INSERT INTO `owned` (`serialNumber`, `description`, `fullDesc`, `date`, `owner`, `name`) VALUES ('$serial', '$description', '$fullDesc', '$date', '$owner', '$name')";
		$db->exec($query);
		$db->exec($index);
	}else{
		$index = "INSERT INTO `ownedleased` (`serialNumber`, `ownedleased`) VALUES ('$serial', 'leased')";
		$query = "INSERT INTO `leased` (`serialNumber`, `description`, `fullDesc`, `date`, `owner`, `name`) VALUES ('$serial', '$description', '$fullDesc', '$date', '$owner', '$name')";
		$db->exec($query);
		$db->exec($index);
}
saveQR($serial);
}


echo json_encode(array('info' => $_POST['keepInfo']));
exit();

?>