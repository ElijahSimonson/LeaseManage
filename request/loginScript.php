<?php
include('../source/api.php');
session_start();
//include('source/connection.php');
if (isset($_COOKIE['user'])){
	$login = $_COOKIE['user'];
	$password = $_COOKIE['pass'];
	$num = fullQuery("SELECT * FROM `users` WHERE user = '$login' AND password = '$password'")->fetch(PDO::FETCH_NUM);
	$info = fullQuery("SELECT * FROM `users` WHERE user = '$login' AND password = '$password'")->fetchObject();
	if ($num[0] > 0){
		$_SESSION['user'] = $_COOKIE['user'];
		$_SESSION['access'] = $info->permissions;
		$_SESSION['identifier'] = $info->orgIdentifier;
	}
	if (isset($_POST['page'])){
		header("Location: ../". $_POST['page']);
	}else{
	header('Location: ../devices.php');
	die;
	}

}
if (isset($_POST)){
	$login = $_POST['login'];
	$password = $_POST['password'];
	$num = fullQuery("SELECT * FROM `users` WHERE user = '$login' AND password = '$password'")->fetch(PDO::FETCH_NUM);
	$info = fullQuery("SELECT * FROM `users` WHERE user = '$login' AND password = '$password'")->fetchObject();
	if ($num[0] > 0){
		if ($_POST['remember'] == 'true' OR $_POST['remember']){
			$forever = 2^31 - 1;
			setcookie("pass", $password, strtotime( '+30 days' ), "/", "", "", TRUE);
			setcookie("user", $login, strtotime( '+30 days' ), "/", "", "", TRUE);
		}
		$_SESSION['user'] = $login;
		$_SESSION['access'] = $info->permissions;
		$_SESSION['identifier'] = $info->orgIdentifier;
	}
	if (isset($_POST['page'])){
		header("Location: ../". $_POST['page']);
	}else{
	header('Location: ../devices.php');
	die;
	}	
}

?>