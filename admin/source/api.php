<?php
if (file_exists('source/phpqrcode/qrlib.php')){
	include('source/phpqrcode/qrlib.php');
}elseif (file_exists('../source/phpqrcode/qrlib.php')) {
	include('../source/phpqrcode/qrlib.php');
}
if (file_exists('source/config.php')){
	include('source/config.php');
}elseif (file_exists('../source/config.php')) {
	include('../source/config.php');
}

if (file_exists('source/connection.php')){
	include('source/connection.php');
}elseif (file_exists('../source/connection.php')) {
	include('../source/connection.php');
}elseif (file_exists('connection.php')) {
	include('connection.php');
}


//Save Qr Codes for device
function saveQR($url) {
	global $homeURL;
	$page = 'http://' .$homeURL . '/qrapp/devdetail.php?serial=' . $url;
	QRcode::png($page, '../QRS/' . $url . '.png', 'L', 4, 4);

};

//Get all device types for newEntry.php dropdown
function getDevices() {
	$deviceType = array();
	global $db;
	$query = "SELECT * FROM `devicetypes`";
	$device = $db->prepare($query);
	$device->execute();
	while ($row = $device->fetchObject()){
		$int = count($deviceType);
		$deviceType[$int] = $row->deviceType;
	}
	return $deviceType;
}	

function checkInput($value){
	if (isset($value)){
		return true;
	}else {
		return false;
	}
}

//Get PDO Object for supplied device
function getDeviceObject($place, $serial){
	global $db;
	if ($place == 'owned'){
		$query = "SELECT * FROM `owned` WHERE serialNumber = '$serial'";
		$device = $db->query($query);
		return $device;
	}elseif ($place == 'leased'){
		$query = "SELECT * FROM `leased` WHERE serialNumber = '$serial'";
		$device = $db->query($query);
		return $device;
	}
	

}

//Load table of devices (Used on the devices.php page)
function devicesTable(){
	global $db;
	$query =  "SELECT * FROM `ownedleased`";
	$data = $db->query($query);
	while ($row =  $data->fetchObject()){
		$place = $row->ownedleased;
		$serial = $row->serialNumber;
		$device = getDeviceObject($place, $serial);
		$rowDev = $device->fetchObject();
		$date = $rowDev->date;
		echo "<tr>
		<td class='serial'><a href='devdetail.php?serial=$serial' class='linktext'>" . $serial . "</a></td>
		<td class='place'>" . $place . "</td>
		<td class='name'>" . $rowDev->name . "</td>
		<td class='description'>"  . $rowDev->description . "</td>
		<td class='owner'>" . $rowDev->owner . "</td>
		<td class='date'>" . $date . "</td>";
		if ($place == 'leased'){
			echo "<td class='assocList' >" .  $rowDev->assocList . "</td>";
		}else{
			echo "<td class='assocList' " . ">Owned</td>";
		}
		echo "<td class='check'><input type='checkbox' value='$place' name='$serial' class='checkbox1'></td>";
		echo "</tr>";
	}
};

function usersTable(){
	global $db;
	$query =  "SELECT * FROM `users`";
	$data = $db->query($query);
	while ($row =  $data->fetchObject()){
		echo "<tr>
		<td class='user'><a href='userdetail.php?user=". $row->user . "' class='linkstext'>" . $row->user . "</a></td>
		<td class='name'>" . $row->name . "</td>";
		if ($row->permissions == 0){
			echo "<td class='permissions'>Device User</td>";
		}elseif ($row->permissions == 1) {
			echo "<td class='permissions'>Device Manager</td>";
		}elseif ($row->permissions == 2){
			echo "<td class='permissions'>IT Administrator</td>";
		}
		echo "<td class='check'><input type='checkbox' value='true' name='$row->user' class='checkbox1'></td>";
		echo "</tr>";
	}
};

//Check if device already exists in database
function checkExists($check){
	global $db;
	$current = 'SELECT serialNumber FROM ownedleased';
	$currDevs = $db->query($current);
	$exists = False;
	while ($currentDev = $currDevs->fetchObject()){
		if ($currentDev->serialNumber == $check){
			$exists = True;
		}
	}

	return $exists;
}

function sendMail($recipient, $body, $subject){

	$mail = new PHPMailer(true);
	header("Content-Type: text/html; charset=ISO-8859-1", true);
	$mail->CharSet = "UTF-8";
	$mail->IsHTML(true);
	global $homeURL;
	global $emailPrefix;
	//$mail->SMTPDebug = 2;
	//Send mail using gmail
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPAuth = true; // enable SMTP authentication	
	$mail->SMTPSecure = "tls"; // sets the prefix to the server
	$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
 	$mail->Port = 587; // set the SMTP port for the GMAIL server
 	$mail->Username = $emailPrefix . "@" . $homeURL; // GMAIL username
 	$mail->Password = "Fiba26link"; // GMAIL password
 	$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
	

	//Typical mail data
	if (is_array($recipient)){
		foreach ($recipient as $key => $value) {
			$mail->AddAddress($value);
		}
	}else{
		$mail->AddAddress($recipient);
	}
	$mail->SetFrom($emailPrefix ."@" . $homeURL);
	$mail->Subject = $subject;
	$mail->Body = $body;
	
	try{
	    $mail->Send();
	    echo "Success!";
	} catch(Exception $e){
	    //Something went bad
	    echo $e;
	}
}

function setCookies($name, $value){
	setCookie($name, $value, time()+ 86400*30, '/');
}

function fixDate($date){
	if (strpos($date, '-')){
		$dateArray = explode('-', $date);
		$date = formatDate($dateArray[0], $dateArray[1], $dateArray[2]);
	}elseif (strpos($date, '/')) {
		$dateArray = explode('/', $date);
		$date = formatDate($dateArray[0], $dateArray[1], $dateArray[2]);
	}elseif (strpos($date, '\\')) {
		$dateArray = explode('\\', $date);
		$date = formatDate($dateArray[0], $dateArray[1], $dateArray[2]);
	}

	return $date;
}

function formatDate($seg1, $seg2, $seg3){
	if(strlen($seg1) == 4) {
		$date = $seg3 . '/' . $seg2 . '/' . $seg1;
	}elseif (strlen($seg3) == 4) {
		$date = $seg1 . '/' . $seg2 . '/' . $seg3;
	}
	return $date;
}

function checkAccess($level){
	if ($level <= $_SESSION['access']){
		return true;
	}else{
		return false;
	}
}

function fullQuery($query){
	global $db;
	$result = $db->prepare($query);
	$result->execute();
	return $result;
}

?>