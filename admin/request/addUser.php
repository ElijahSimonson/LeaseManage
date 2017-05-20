<?php
include('../source/api.php');

$access = $_POST['access'];
$user = $_POST['user'];
$password = $_POST['password'];
$name = $_POST['name'];

if ($_POST['email'] == ""){
	$email = $user . "@spotswoodcolege.school.nz";
}else{
	$email = $_POST['email'];;
};

if (!checkUserExists($user)){
	$query = "INSERT INTO `users` (`user`, `name`, `password`, `email`, `access`) VALUES ('$user', '$name', '$password', '$email', '$access')";
	$db->exec($query);
}


echo json_encode("success");
exit();

?>